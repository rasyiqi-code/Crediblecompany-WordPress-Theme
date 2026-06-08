<?php
/**
 * Engine Whitelabel Dashboard Admin WordPress.
 * Fitur whitelabeling untuk menyembunyikan widget bawaan, opsi yang tidak perlu, dan menyederhanakan halaman profil.
 * Komentar di kode menggunakan bahasa Indonesia.
 *
 * @package CredibleCompany
 */

// Mencegah akses langsung
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Cek apakah fitur tema admin kustom aktif
if ( ! get_theme_mod( 'cc_enable_admin_theme', false ) ) {
    return;
}

/* --------------------------------------------------------------------------
 * 1. Pembersihan Dashboard & Widget
 * ---------------------------------------------------------------------- */

// Menghapus widget dashboard bawaan yang tidak diperlukan
add_action( 'wp_dashboard_setup', 'cc_remove_dashboard_widgets' );
function cc_remove_dashboard_widgets() {
    $widgets_to_remove = array(
        'e-dashboard-overview',
        'dashboard_site_health',
        'dashboard_right_now',
        'dashboard_activity',
        'google_dashboard_widget',
        'dashboard_quick_press',
        'dashboard_primary',
    );
    foreach ( $widgets_to_remove as $widget ) {
        remove_meta_box( $widget, 'dashboard', in_array( $widget, array( 'dashboard_quick_press', 'dashboard_primary' ), true ) ? 'side' : 'normal' );
    }
}

// Mengatur layout dashboard menjadi 1 kolom secara paksa
add_action( 'admin_init', 'cc_set_single_column_dashboard_layout' );
function cc_set_single_column_dashboard_layout() {
    add_filter( 'get_user_option_screen_layout_dashboard', function() {
        return 1;
    } );
}

// Menambahkan CSS kustom agar widget dashboard memenuhi lebar penuh (full width)
add_action( 'admin_head', 'cc_custom_dashboard_full_width_css' );
function cc_custom_dashboard_full_width_css() {
    echo '<style>
        #dashboard-widgets .postbox-container {
            width: 100% !important;
        }
        #dashboard-widgets-wrap {
            display: flex;
            flex-direction: column;
        }
        #postbox-container-1,
        #postbox-container-2,
        #postbox-container-3,
        #postbox-container-4 {
            width: 100% !important;
        }
    </style>';
}

// Menyembunyikan container postbox dashboard yang kosong setelah widget dihapus
add_action( 'admin_head', 'cc_remove_empty_postbox_containers' );
function cc_remove_empty_postbox_containers() {
    ?>
    <script>
        jQuery(document).ready(function($) {
            var containers = [
                '#postbox-container-2 .meta-box-sortables',
                '#postbox-container-3 .meta-box-sortables',
                '#postbox-container-4 .meta-box-sortables'
            ];
            containers.forEach(function(container) {
                if ($(container).children().length === 0) {
                    $(container).closest('.postbox-container').hide();
                }
            });
        });
    </script>
    <?php
}

/* --------------------------------------------------------------------------
 * 2. Pembersihan Admin Bar (Top Bar)
 * ---------------------------------------------------------------------- */

// Menghapus logo WordPress dari Admin Bar
add_action( 'admin_bar_menu', 'cc_remove_wp_logo', 999 );
function cc_remove_wp_logo( $wp_admin_bar ) {
    $wp_admin_bar->remove_menu( 'wp-logo' );
}

// Menghapus item "Baru" (New Content) dari Admin Bar
add_action( 'wp_before_admin_bar_render', 'cc_remove_admin_bar_item' );
function cc_remove_admin_bar_item() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_node( 'new-content' );
}

// Menyembunyikan item admin bar tertentu (My Sites dan Komentar)
add_action( 'admin_footer', 'cc_hide_admin_bar_items' );
add_action( 'wp_footer', 'cc_hide_admin_bar_items' );
function cc_hide_admin_bar_items() {
    echo '
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var itemsToHide = ["wp-admin-bar-my-sites", "wp-admin-bar-comments"];
            itemsToHide.forEach(function(item) {
                var el = document.getElementById(item);
                if (el) {
                    el.style.display = "none";
                }
            });
        });
    </script>
    ';
}

// Menyembunyikan menu bar Flying Press untuk user non-super admin
add_action( 'admin_head', 'cc_hide_menu_for_non_super_admins' );
function cc_hide_menu_for_non_super_admins() {
    if ( ! current_user_can( 'manage_network' ) ) {
        echo '<style>#wp-admin-bar-flying-press { display: none !important; }</style>';
    }
}

/* --------------------------------------------------------------------------
 * 3. Navigasi & Kolom Komentar (Pembersihan Komentar)
 * ---------------------------------------------------------------------- */

// Menghapus menu Komentar dari Sidebar Admin Menu
add_action( 'admin_menu', 'cc_remove_comments_menu' );
function cc_remove_comments_menu() {
    remove_menu_page( 'edit-comments.php' );
}

// Menghapus kolom Komentar dari daftar postingan dan halaman
add_filter( 'manage_posts_columns', 'cc_remove_comments_columns' );
add_filter( 'manage_pages_columns', 'cc_remove_comments_columns' );
function cc_remove_comments_columns( $columns ) {
    unset( $columns['comments'] );
    return $columns;
}

// Menghapus dukungan komentar dan trackback dari tipe postingan 'post'
add_action( 'init', 'cc_remove_discussion_panel' );
function cc_remove_discussion_panel() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'post', 'trackbacks' );
}

/* --------------------------------------------------------------------------
 * 4. Kustomisasi Meta & Footer
 * ---------------------------------------------------------------------- */

// Menyembunyikan Screen Options dan Help tab di atas kanan halaman admin
add_action( 'admin_head', 'cc_remove_screen_options_help' );
function cc_remove_screen_options_help() {
    echo '<style>#screen-meta-links { display: none !important; }</style>';
}

// Menyembunyikan area footer admin sepenuhnya via CSS
add_action( 'admin_head', 'cc_remove_footer_admin' );
function cc_remove_footer_admin() {
    echo '<style>#wpfooter { display: none !important; }</style>';
}

// Mengubah title halaman admin agar berakhiran Nama Situs
add_filter( 'admin_title', 'cc_change_admin_title', 10, 2 );
function cc_change_admin_title( $admin_title, $title ) {
    return get_bloginfo( 'name' ) . ' • ' . $title;
}

/* --------------------------------------------------------------------------
 * 5. Penyederhanaan Halaman Profil & Opsi Pengguna
 * ---------------------------------------------------------------------- */

// Menyembunyikan Opsi Personal dan Opsi Elementor AI/Notes bagi administrator situs non-super admin
add_action( 'admin_head', 'cc_hide_personal_options_and_elementor_for_site_admins' );
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
