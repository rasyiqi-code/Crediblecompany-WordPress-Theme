<?php
/**
 * Functions utama tema Credible Company.
 * Memuat modul-modul dari folder inc/ dan mendaftarkan fitur tema.
 *
 * @package CredibleCompany
 */

// Sembunyikan Admin Bar
add_filter( 'show_admin_bar', '__return_false' );

/* --------------------------------------------------------------------------
 * 1. Muat modul-modul pendukung dari folder inc/
 * ---------------------------------------------------------------------- */
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/post-views.php';
require_once get_template_directory() . '/inc/ajax-loadmore.php';
require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/cpt-paket-jasa.php';
require_once get_template_directory() . '/inc/cpt-testimoni.php';
require_once get_template_directory() . '/inc/cpt-marketing.php';
require_once get_template_directory() . '/inc/custom-comments.php';
require_once get_template_directory() . '/inc/toc-generator.php';
require_once get_template_directory() . '/inc/dynamic-wa.php';
require_once get_template_directory() . '/inc/performance-optimizer.php';
require_once get_template_directory() . '/inc/security-optimizer.php';

/* --------------------------------------------------------------------------
 * 2. Setup Tema
 * ---------------------------------------------------------------------- */
add_action( 'after_setup_theme', function () {
    // Dukung tag <title> otomatis
    add_theme_support( 'title-tag' );

    // Dukung gambar featured / thumbnail
    add_theme_support( 'post-thumbnails' );

    // HTML5 markup
    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ) );

    // Custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Register menu navigasi
    register_nav_menus( array(
        'primary_navigation' => __( 'Navigasi Utama', 'crediblecompany' ),
        'footer_navigation'  => __( 'Navigasi Footer', 'crediblecompany' ),
    ) );
} );

/* --------------------------------------------------------------------------
 * 3. Register Sidebars / Widget Areas
 * ---------------------------------------------------------------------- */
add_action( 'widgets_init', function () {
    register_sidebar( array(
        'name'          => __( 'Footer Widget', 'crediblecompany' ),
        'id'            => 'footer-widget',
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Sidebar Iklan Artikel', 'crediblecompany' ),
        'id'            => 'sidebar-iklan',
        'description'   => __( 'Tambahkan banner/iklan di sini (ditampilkan di sisi kanan single post desktop).', 'crediblecompany' ),
        'before_widget' => '<div class="sidebar-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title" style="display:none;">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Sidebar Iklan Kiri', 'crediblecompany' ),
        'id'            => 'sidebar-iklan-kiri',
        'description'   => __( 'Tambahkan banner/iklan di sini (ditampilkan di sisi kiri single testimoni).', 'crediblecompany' ),
        'before_widget' => '<div class="sidebar-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title" style="display:none;">',
        'after_title'   => '</h4>',
    ) );
} );

/* --------------------------------------------------------------------------
 * 4. Fungsi Penerima Form "Submit Testimoni" (Front-End -> Pending CPT)
 * ---------------------------------------------------------------------- */
add_action( 'admin_post_nopriv_submit_testimoni_action', 'cc_handle_submit_testimoni' );
add_action( 'admin_post_submit_testimoni_action', 'cc_handle_submit_testimoni' );

function cc_handle_submit_testimoni() {
    // Validasi Nonce
    if ( ! isset( $_POST['testimoni_nonce'] ) || ! wp_verify_nonce( $_POST['testimoni_nonce'], 'submit_testimoni_nonce' ) ) {
        wp_die( 'Akses tidak sah!', 'Error', array( 'response' => 403 ) );
    }

    $name    = sanitize_text_field( $_POST['client_name'] );
    $title   = sanitize_text_field( $_POST['client_title'] );
    $rating  = intval( $_POST['client_rating'] );
    $review  = sanitize_textarea_field( $_POST['client_review'] );

    if ( empty( $name ) || empty( $title ) || empty( $rating ) || empty( $review ) || empty( $_FILES['client_photo']['name'] ) ) {
        wp_redirect( add_query_arg( 'err', '1', wp_get_referer() ) );
        exit;
    }

    // Validasi Ukuran File (Max 2MB)
    $max_size = 2 * 1024 * 1024; // 2MB
    if ( $_FILES['client_photo']['size'] > $max_size ) {
        wp_die( 'Ukuran file foto melebihi batas maksimum 2MB.', 'Error Upload', array( 'response' => 400 ) );
    }

    // Validasi Ekstensi/MIME Type (Hanya JPG/PNG)
    $allowed_mimes = array(
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png'  => 'image/png',
    );
    $file_info = wp_check_filetype( basename( $_FILES['client_photo']['name'] ), $allowed_mimes );
    if ( empty( $file_info['ext'] ) || empty( $file_info['type'] ) ) {
        wp_die( 'Hanya format gambar JPG dan PNG yang diperbolehkan.', 'Error Upload', array( 'response' => 400 ) );
    }

    // Buat Postingan Testimoni "Menunggu Peninjauan" (Pending)
    $post_id = wp_insert_post( array(
        'post_title'   => $name,
        'post_content' => $review,
        'post_status'  => 'pending',
        'post_type'    => 'testimoni',
    ) );

    if ( $post_id ) {
        update_post_meta( $post_id, 'cc_testimonial_title', $title );
        update_post_meta( $post_id, 'cc_testimonial_rating', $rating );

        // Tangani Unggahan Foto
        if ( ! empty( $_FILES['client_photo']['name'] ) ) {
            require_once( ABSPATH . 'wp-admin/includes/image.php' );
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            require_once( ABSPATH . 'wp-admin/includes/media.php' );
            
            $attachment_id = media_handle_upload( 'client_photo', $post_id );
            
            if ( ! is_wp_error( $attachment_id ) ) {
                set_post_thumbnail( $post_id, $attachment_id );
            }
        }
        
        // redirect ke asal dg url arg status=berhasil
        wp_redirect( add_query_arg( 'success', 'true', wp_get_referer() ) );
        exit;
    } else {
        wp_die( 'Gagal menyimpan data ke Sistem.' );
    }
}

/**
 * Atur jumlah post per halaman untuk arsip testimoni.
 */
add_action( 'pre_get_posts', function ( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'testimoni' ) ) {
        $query->set( 'posts_per_page', 9 );
    }
} );

require_once get_template_directory() . '/inc/breadcrumbs.php';
require_once get_template_directory() . '/inc/seo-optimizer.php';

/* --------------------------------------------------------------------------
 * 2. Setup Tema
 * ---------------------------------------------------------------------- */
