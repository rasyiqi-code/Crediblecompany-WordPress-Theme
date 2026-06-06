<?php
/**
 * Modular Form Handler: Submit Testimoni.
 * Menangani pemrosesan pengiriman ulasan/testimoni dari front-end.
 *
 * @package CredibleCompany
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'admin_post_nopriv_submit_testimoni_action', 'cc_handle_submit_testimoni' );
add_action( 'admin_post_submit_testimoni_action', 'cc_handle_submit_testimoni' );

/**
 * AJAX Endpoint: Memberikan nonce segar untuk form testimoni.
 * Dipanggil oleh JS sebelum submit agar kompatibel dengan halaman yang di-cache.
 * Nonce tidak ada di markup statis — hanya diambil saat user hendak submit.
 */
add_action( 'wp_ajax_nopriv_cc_get_testimoni_nonce', 'cc_ajax_get_testimoni_nonce' );
add_action( 'wp_ajax_cc_get_testimoni_nonce', 'cc_ajax_get_testimoni_nonce' );
function cc_ajax_get_testimoni_nonce() {
    wp_send_json_success( array(
        'nonce' => wp_create_nonce( 'cc_submit_testimoni' ),
    ) );
}

/**
 * Handle form submission untuk testimoni publik.
 */
function cc_handle_submit_testimoni() {
    // 1. Proteksi Spam Honeypot
    if ( ! empty( $_POST['cc_hp_email'] ) ) {
        wp_die( 'Aktivitas mencurigakan terdeteksi (Spam).', 'Akses Ditolak', array( 'response' => 403 ) );
    }

    // 2. Validasi CSRF Nonce (dikirim JS sebelum submit untuk kompatibilitas cache)
    if ( ! isset( $_POST['_cc_nonce'] ) || ! wp_verify_nonce( $_POST['_cc_nonce'], 'cc_submit_testimoni' ) ) {
        wp_die( 'Sesi keamanan tidak valid atau kedaluwarsa. Silakan refresh halaman dan coba lagi.', 'Akses Ditolak', array( 'response' => 403 ) );
    }

    $name    = sanitize_text_field( $_POST['client_name'] );
    $title   = sanitize_text_field( $_POST['client_title'] );
    $city    = sanitize_text_field( $_POST['client_city'] );
    $rating  = intval( $_POST['client_rating'] );
    $review  = sanitize_textarea_field( $_POST['client_review'] );

    $referer = wp_get_referer() ? wp_get_referer() : home_url();

    if ( empty( $name ) || empty( $title ) || empty( $city ) || empty( $rating ) || empty( $review ) || empty( $_FILES['client_photo']['name'] ) ) {
        wp_redirect( add_query_arg( 'err', '1', $referer ) );
        exit;
    }

    // Validasi Ukuran File (Max 1MB)
    $max_size = 1 * 1024 * 1024; // 1MB
    if ( $_FILES['client_photo']['size'] > $max_size ) {
        wp_die( 'Ukuran file foto melebihi batas maksimum 1MB.', 'Error Upload', array( 'response' => 400 ) );
    }

    // Validasi Dimensi (Rasio wajar, tidak terlalu panjang/lebar)
    $img_info = @getimagesize( $_FILES['client_photo']['tmp_name'] );
    if ( $img_info ) {
        $width  = $img_info[0];
        $height = $img_info[1];
        $ratio  = $width / $height;
        if ( $ratio < 0.75 || $ratio > 1.33 ) {
            wp_die( 'Rasio gambar terlalu ekstrem. Pastikan gambar tidak terlalu persegi panjang (lebar dan tinggi kurang lebih seimbang).', 'Error Upload', array( 'response' => 400 ) );
        }
    } else {
        wp_die( 'File yang diunggah bukan gambar yang valid.', 'Error Upload', array( 'response' => 400 ) );
    }

    // Validasi Ekstensi/MIME Type (Hanya JPG/PNG/WEBP)
    $allowed_mimes = array(
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png'  => 'image/png',
        'webp' => 'image/webp',
    );
    
    // Periksa ekstensi nama file
    $file_info = wp_check_filetype( basename( $_FILES['client_photo']['name'] ), $allowed_mimes );
    if ( empty( $file_info['ext'] ) || empty( $file_info['type'] ) ) {
        wp_die( 'Hanya format gambar JPG, PNG, dan WEBP yang diperbolehkan.', 'Error Upload', array( 'response' => 400 ) );
    }

    // Periksa tipe MIME fisik file temp untuk mencegah pemalsuan ekstensi (bypass file jahat)
    if ( function_exists( 'mime_content_type' ) ) {
        $real_mime = mime_content_type( $_FILES['client_photo']['tmp_name'] );
        if ( ! in_array( $real_mime, $allowed_mimes, true ) ) {
            wp_die( 'Isi file tidak cocok dengan format gambar yang diperbolehkan.', 'Error Upload', array( 'response' => 400 ) );
        }
    }

    // Buat Postingan Testimoni "Menunggu Peninjauan" (Pending)
    $post_id = wp_insert_post( array(
        'post_title'   => $name,
        'post_content' => $review,
        'post_status'  => 'pending',
        'post_type'    => 'testimoni',
    ) );

    if ( $post_id ) {
        // 1. Simpan ke meta key canonical tema (_customer_*) - Digunakan untuk Kolom Admin & Kartu Testimoni
        update_post_meta( $post_id, '_customer_name', $name );
        update_post_meta( $post_id, '_customer_profession', $title );
        update_post_meta( $post_id, '_customer_city', $city );
        update_post_meta( $post_id, '_customer_rating', $rating );

        // 2. Simpan ke meta key legacy/SEO (cc_testimonial_*) - Digunakan untuk SEO Optimizer & kompatibilitas lama
        update_post_meta( $post_id, 'cc_testimonial_title', $title );
        update_post_meta( $post_id, 'cc_testimonial_rating', $rating );

        // Tangani Unggahan Foto & Convert ke WEBP
        if ( ! empty( $_FILES['client_photo']['name'] ) ) {
            // Coba convert gambar ke webp secara on-the-fly
            $editor = wp_get_image_editor( $_FILES['client_photo']['tmp_name'] );
            if ( ! is_wp_error( $editor ) ) {
                $editor->set_quality( 80 );
                $tmp_webp = dirname( $_FILES['client_photo']['tmp_name'] ) . '/' . wp_unique_filename( dirname( $_FILES['client_photo']['tmp_name'] ), 'converted.webp' );
                $saved = $editor->save( $tmp_webp, 'image/webp' );
                if ( ! is_wp_error( $saved ) ) {
                    // Berhasil dikonversi, timpa detail $_FILES
                    $_FILES['client_photo']['tmp_name'] = $saved['path'];
                    $_FILES['client_photo']['type']     = 'image/webp';
                    
                    $name_parts = pathinfo( $_FILES['client_photo']['name'] );
                    $_FILES['client_photo']['name'] = $name_parts['filename'] . '.webp';
                    $_FILES['client_photo']['size'] = filesize( $saved['path'] );
                }
            }
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );
            
            $attachment_id = media_handle_upload( 'client_photo', $post_id );
            
            if ( ! is_wp_error( $attachment_id ) ) {
                set_post_thumbnail( $post_id, $attachment_id );
            }
        }
        
        // redirect ke asal dg url arg status=berhasil
        wp_redirect( add_query_arg( 'success', 'true', $referer ) );
        exit;
    } else {
        wp_die( 'Gagal menyimpan data ke Sistem.' );
    }
}
