<?php
/**
 * Engine Whitelabel Dashboard Admin WordPress.
 * Fitur whitelabeling untuk menyembunyikan widget bawaan, opsi yang tidak perlu, menyederhanakan halaman profil,
 * serta menonaktifkan fitur komentar secara global dan dinamis.
 * Komentar di kode menggunakan bahasa Indonesia.
 *
 * @package CredibleCompany
 */

// Mencegah akses langsung
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* --------------------------------------------------------------------------
 * Inisialisasi Fitur Bersyarat
 * ---------------------------------------------------------------------- */

// 1. Jika Kustomisasi Tema Admin Aktif
if ( get_theme_mod( 'cc_enable_admin_theme', false ) ) {
    // Pembersihan Dashboard
    add_action( 'wp_dashboard_setup', 'cc_remove_dashboard_widgets' );

    // Pembersihan Admin Bar
    add_action( 'admin_bar_menu', 'cc_remove_wp_logo', 999 );
    add_action( 'wp_before_admin_bar_render', 'cc_remove_admin_bar_item' );
    add_action( 'admin_footer', 'cc_hide_admin_bar_items' );
    add_action( 'wp_footer', 'cc_hide_admin_bar_items' );
    add_action( 'admin_head', 'cc_hide_menu_for_non_super_admins' );

    // Kustomisasi Meta & Footer
    add_action( 'admin_head', 'cc_remove_screen_options_help' );
    add_action( 'admin_head', 'cc_remove_footer_admin' );
    add_filter( 'admin_title', 'cc_change_admin_title', 10, 2 );

    // Profil Pengguna
    add_action( 'admin_head', 'cc_hide_personal_options_and_elementor_for_site_admins' );

    // Menyembunyikan elemen komentar di dashboard utama (Sekilas & Aktivitas) secara permanen
    add_action( 'admin_head', 'cc_hide_comments_dashboard_elements' );
}

// 2. Jika Fitur Komentar Global Dinonaktifkan
if ( ! get_theme_mod( 'cc_enable_comments', true ) ) {
    // Navigasi & Kolom Komentar (Backend)
    add_action( 'admin_menu', 'cc_remove_comments_menu' );
    add_filter( 'manage_posts_columns', 'cc_remove_comments_columns' );
    add_filter( 'manage_pages_columns', 'cc_remove_comments_columns' );
    add_action( 'init', 'cc_remove_comments_support' );

    // Menonaktifkan status open komentar di frontend & backend
    add_filter( 'comments_open', '__return_false', 20, 2 );
    add_filter( 'pings_open', '__return_false', 20, 2 );

    // Menyembunyikan menu bar komentar secara backend
    add_action( 'admin_bar_menu', 'cc_remove_comments_admin_bar_node', 999 );
}

// 3. Pengalihan Halaman Admin untuk CPT yang Dinonaktifkan (Selalu Aktif)
add_action( 'admin_init', 'cc_redirect_disabled_cpt_admin_pages' );


/* --------------------------------------------------------------------------
 * Bagian 1: Logika Pembersihan Dashboard & Widget
 * ---------------------------------------------------------------------- */

// Menghapus seluruh widget dashboard bawaan WordPress agar bersih total
function cc_remove_dashboard_widgets() {
    $widgets_to_remove = array(
        'dashboard_quick_press', // Draft Cepat
        'dashboard_primary',     // Berita & Acara WordPress
        'dashboard_activity',    // Aktivitas
        'dashboard_right_now',   // Sekilas (At a Glance)
        'dashboard_site_health', // Status Kesehatan Situs (Site Health)
    );
    foreach ( $widgets_to_remove as $widget ) {
        $context = in_array( $widget, array( 'dashboard_quick_press', 'dashboard_primary' ), true ) ? 'side' : 'normal';
        remove_meta_box( $widget, 'dashboard', $context );
    }
}


/* --------------------------------------------------------------------------
 * Bagian 2: Logika Pembersihan Admin Bar (Top Bar)
 * ---------------------------------------------------------------------- */

// Menghapus logo WordPress dari Admin Bar
function cc_remove_wp_logo( $wp_admin_bar ) {
    $wp_admin_bar->remove_menu( 'wp-logo' );
}

// Menghapus item "Baru" (New Content) dari Admin Bar
function cc_remove_admin_bar_item() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_node( 'new-content' );
}

// Menyembunyikan item admin bar tertentu (My Sites) via JavaScript
function cc_hide_admin_bar_items() {
    echo '
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var el = document.getElementById("wp-admin-bar-my-sites");
            if (el) {
                el.style.display = "none";
            }
        });
    </script>
    ';
}

// Menyembunyikan menu bar Flying Press untuk user non-super admin
function cc_hide_menu_for_non_super_admins() {
    if ( ! current_user_can( 'manage_network' ) ) {
        echo '<style>#wp-admin-bar-flying-press { display: none !important; }</style>';
    }
}


/* --------------------------------------------------------------------------
 * Bagian 3: Logika Pembersihan Komentar Dinamis
 * ---------------------------------------------------------------------- */

// Menghapus menu Komentar dari Sidebar Admin Menu
function cc_remove_comments_menu() {
    remove_menu_page( 'edit-comments.php' );
}

// Menghapus kolom Komentar dari daftar postingan dan halaman
function cc_remove_comments_columns( $columns ) {
    unset( $columns['comments'] );
    return $columns;
}

// Menghapus dukungan komentar dan trackback dari tipe postingan bawaan
function cc_remove_comments_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'post', 'trackbacks' );
    remove_post_type_support( 'page', 'comments' );
    remove_post_type_support( 'page', 'trackbacks' );
    remove_post_type_support( 'attachment', 'comments' );
}

// Menyembunyikan menu bar komentar dari Admin Bar secara backend
function cc_remove_comments_admin_bar_node( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'comments' );
}

// Menyembunyikan elemen komentar di widget dashboard (Sekilas & Aktivitas) via CSS
function cc_hide_comments_dashboard_elements() {
    echo '<style>
        /* Sembunyikan jumlah komentar di widget Sekilas (At a Glance) */
        #dashboard_right_now .comment-count,
        #dashboard_right_now .comment-mod-count {
            display: none !important;
        }
        /* Sembunyikan komentar terbaru di widget Aktivitas */
        #latest-comments {
            display: none !important;
        }
    </style>';
}


/* --------------------------------------------------------------------------
 * Bagian 4: Kustomisasi Meta & Footer Admin
 * ---------------------------------------------------------------------- */

// Menyembunyikan Screen Options dan Help tab di atas kanan halaman admin
function cc_remove_screen_options_help() {
    echo '<style>#screen-meta-links { display: none !important; }</style>';
}

// Menyembunyikan area footer admin sepenuhnya via CSS
function cc_remove_footer_admin() {
    echo '<style>#wpfooter { display: none !important; }</style>';
}

// Mengubah title halaman admin agar berakhiran Nama Situs
function cc_change_admin_title( $admin_title, $title ) {
    return get_bloginfo( 'name' ) . ' • ' . $title;
}


/* --------------------------------------------------------------------------
 * Bagian 5: Penyederhanaan Halaman Profil & Opsi Pengguna
 * ---------------------------------------------------------------------- */

// Menyembunyikan Opsi Personal dan Opsi Elementor AI/Notes bagi administrator situs non-super admin
function cc_hide_personal_options_and_elementor_for_site_admins() {
    // 1. IZIN: Hentikan jika user adalah Super Admin (Super Admin tetap bisa melihat semuanya)
    if ( is_super_admin() ) {
        return;
    }

    // 2. IZIN: Pastikan user adalah Administrator situs
    if ( ! current_user_can( 'administrator' ) ) {
        return;
    }

    // 3. LOKASI: Hanya jalankan di halaman Profil User
    $screen = get_current_screen();
    if ( ! $screen || ! in_array( $screen->base, array( 'profile', 'user-edit' ), true ) ) {
        return;
    }

    ?>
    <style>
        /* --- BAGIAN 1: Sembunyikan Isi 'Opsi Personal' via CSS --- */
        /* Kita gunakan class bawaan WordPress agar lebih cepat dan tidak berkedip */
        
        /* Warna Admin */
        tr.user-admin-color-wrap,
        /* Syntax Highlighting */
        tr.user-syntax-highlighting-wrap,
        /* Keyboard Shortcuts */
        tr.user-comment-shortcuts-wrap,
        /* Admin Bar (Toolbar) */
        tr.show-admin-bar.user-admin-bar-front-wrap,
        /* Bahasa */
        tr.user-language-wrap {
            display: none !important;
        }

        /* Sembunyikan baris input Elementor jika memiliki ID spesifik */
        tr:has(#elementor_enable_ai),
        tr:has(#elementor_pro_enable_notes_notifications) {
            display: none !important;
        }
    </style>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            
            // Daftar Judul (H2) yang ingin disembunyikan
            // Kita masukkan Bahasa Indonesia dan Inggris untuk jaga-jaga
            var titlesToHide = [
                'Opsi Personal', 
                'Personal Options', 
                'Elementor - AI', 
                'Elementor - Notes',
                'Elementor - Catatan' // Jaga-jaga jika ada terjemahan lain
            ];

            $('h2').filter(function() {
                var text = $(this).text().trim();
                // Cek apakah teks h2 ada di dalam daftar yang mau disembunyikan
                return titlesToHide.includes(text);
            }).each(function() {
                // 1. Sembunyikan Judul H2 itu sendiri
                $(this).hide();
                
                // 2. Sembunyikan elemen (tabel) tepat di bawahnya
                // Elementor biasanya menaruh opsi tepat setelah H2 dalam form-table
                $(this).next('.form-table').hide();
                
                // Fallback: Sembunyikan elemen apapun tepat di bawahnya jika bukan form-table
                $(this).next().hide(); 
            });
        });
    </script>
    <?php
}


/* --------------------------------------------------------------------------
 * Bagian 6: Pengalihan Halaman Admin untuk CPT yang Dinonaktifkan
 * ---------------------------------------------------------------------- */

// Pengalihan CPT yang Dinonaktifkan (Pencegah Error "Invalid Post Type")
function cc_redirect_disabled_cpt_admin_pages() {
    global $pagenow;
    
    // Pastikan kita sedang berada di halaman edit pos admin (edit.php, post-new.php, post.php)
    if ( ! in_array( $pagenow, array( 'edit.php', 'post-new.php', 'post.php' ), true ) ) {
        return;
    }

    $cpt_to_check = '';

    // Ambil post type dari parameter URL GET
    if ( isset( $_GET['post_type'] ) ) {
        $cpt_to_check = sanitize_key( $_GET['post_type'] );
    } elseif ( isset( $_GET['post'] ) ) {
        $post_id      = intval( $_GET['post'] );
        $cpt_to_check = get_post_type( $post_id );
    }

    if ( empty( $cpt_to_check ) ) {
        return;
    }

    $should_redirect = false;

    // 1. Cek CPT Testimoni
    if ( 'testimoni' === $cpt_to_check && ! get_theme_mod( 'cc_testimonials_enable', true ) ) {
        $should_redirect = true;
    }

    // 2. Cek CPT Marketing
    if ( 'marketing' === $cpt_to_check && ! get_theme_mod( 'cc_marketing_enable', true ) ) {
        $should_redirect = true;
    }

    if ( $should_redirect ) {
        wp_safe_redirect( admin_url( 'index.php' ) );
        exit;
    }
}
