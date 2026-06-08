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

    // Pendaftaran Widget Kustom Support
    add_action( 'wp_dashboard_setup', 'cc_add_custom_support_dashboard_widgets', 20 );
    add_action( 'admin_head', 'cc_support_widgets_custom_css' );

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

// Mendaftarkan widget dashboard kustom baru (KBM Support & Developer Support)
function cc_add_custom_support_dashboard_widgets() {
    wp_add_dashboard_widget(
        'cc_kbm_support_widget',
        __( 'KBM Support', 'crediblecompany' ),
        'cc_kbm_support_widget_display'
    );

    wp_add_dashboard_widget(
        'cc_developer_support_widget',
        __( 'Developer Support', 'crediblecompany' ),
        'cc_developer_support_widget_display'
    );
}

// Merender konten widget KBM Support
function cc_kbm_support_widget_display() {
    $wa_num   = get_theme_mod( 'cc_kbm_support_wa', '6281357517526' );
    $web_url  = get_theme_mod( 'cc_kbm_support_web', 'https://penerbitkbm.com/' );
    
    // Dapatkan nama host untuk tampilan teks link yang rapi
    $web_host = parse_url( $web_url, PHP_URL_HOST );
    if ( empty( $web_host ) ) {
        $web_host = str_replace( array( 'http://', 'https://' ), '', $web_url );
    }

    // Bersihkan nomor WhatsApp dari karakter non-digit untuk link wa.me
    $wa_clean = preg_replace( '/[^0-9]/', '', $wa_num );
    ?>
    <div class="cc-dashboard-widget-content">
        <p style="margin-bottom: 15px; color: #475569; font-size: 13px; line-height: 1.6;">
            Dapatkan bantuan layanan penerbitan buku, pemasaran, dan dukungan operasional langsung dari tim KBM Support kami di <a href="<?php echo esc_url( $web_url ); ?>" target="_blank" style="color: #c01314; text-decoration: underline; font-weight: 600;"><?php echo esc_html( $web_host ); ?></a>.
        </p>
        <div style="display: flex; flex-direction: column; gap: 8px;">
            <a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: #25d366; color: #fff; padding: 10px 15px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 13px; transition: all 0.2s ease-in-out;" class="cc-support-btn wa-btn">
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24" style="margin-top: 1px;"><path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.96 9.96 0 001.333 4.982L2 22l5.233-1.371a9.948 9.948 0 004.773 1.21h.005c5.505 0 9.989-4.478 9.99-9.984A9.998 9.998 0 0012.012 2zm5.727 14.153c-.246.696-1.233 1.277-1.696 1.325-.463.048-.962.062-1.602-.144a7.373 7.373 0 01-3.217-1.89 7.42 7.42 0 01-1.89-3.217 3.513 3.513 0 01-.144-1.602c.048-.463.629-1.45 1.325-1.696.177-.063.35-.12.493-.12.143 0 .229.006.335.012a1.867 1.867 0 01.442.06c.148.042.316.14.417.375.14.331.479 1.168.52 1.25.042.083.07.18.013.298-.057.118-.086.19-.172.29-.086.1-.182.222-.26.3-.086.086-.176.18-.076.353a4.996 4.996 0 001.21 1.48c.465.412.92.68 1.092.766.172.086.27.071.37-.043.1-.115.43-.502.545-.674.115-.172.229-.144.387-.086.158.058 1.004.474 1.176.56.172.086.287.13.33.202.043.072.043.416-.203 1.112z"/></svg>
                WhatsApp KBM Support
            </a>
        </div>
    </div>
    <?php
}

// Merender konten widget Developer Support
function cc_developer_support_widget_display() {
    $wa_num   = get_theme_mod( 'cc_developer_support_wa', '6285183131249' );
    $web_url  = get_theme_mod( 'cc_developer_support_web', 'https://crediblemark.com/' );

    // Dapatkan nama host untuk tampilan teks link yang rapi
    $web_host = parse_url( $web_url, PHP_URL_HOST );
    if ( empty( $web_host ) ) {
        $web_host = str_replace( array( 'http://', 'https://' ), '', $web_url );
    }

    // Bersihkan nomor WhatsApp dari karakter non-digit untuk link wa.me
    $wa_clean = preg_replace( '/[^0-9]/', '', $wa_num );
    ?>
    <div class="cc-dashboard-widget-content">
        <p style="margin-bottom: 15px; color: #475569; font-size: 13px; line-height: 1.6;">
            Butuh bantuan teknis, perbaikan bug, atau penambahan fitur kustom pada website? Hubungi tim Developer kami langsung dari <a href="<?php echo esc_url( $web_url ); ?>" target="_blank" style="color: #c01314; text-decoration: underline; font-weight: 600;"><?php echo esc_html( $web_host ); ?></a>.
        </p>
        <div style="display: flex; flex-direction: column; gap: 8px;">
            <a href="https://wa.me/<?php echo esc_attr( $wa_clean ); ?>" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; gap: 8px; background: #25d366; color: #fff; padding: 10px 15px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 13px; transition: all 0.2s ease-in-out;" class="cc-support-btn wa-btn">
                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24" style="margin-top: 1px;"><path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.96 9.96 0 001.333 4.982L2 22l5.233-1.371a9.948 9.948 0 004.773 1.21h.005c5.505 0 9.989-4.478 9.99-9.984A9.998 9.998 0 0012.012 2zm5.727 14.153c-.246.696-1.233 1.277-1.696 1.325-.463.048-.962.062-1.602-.144a7.373 7.373 0 01-3.217-1.89 7.42 7.42 0 01-1.89-3.217 3.513 3.513 0 01-.144-1.602c.048-.463.629-1.45 1.325-1.696.177-.063.35-.12.493-.12.143 0 .229.006.335.012a1.867 1.867 0 01.442.06c.148.042.316.14.417.375.14.331.479 1.168.52 1.25.042.083.07.18.013.298-.057.118-.086.19-.172.29-.086.1-.182.222-.26.3-.086.086-.176.18-.076.353a4.996 4.996 0 001.21 1.48c.465.412.92.68 1.092.766.172.086.27.071.37-.043.1-.115.43-.502.545-.674.115-.172.229-.144.387-.086.158.058 1.004.474 1.176.56.172.086.287.13.33.202.043.072.043.416-.203 1.112z"/></svg>
                WhatsApp Developer
            </a>
        </div>
    </div>
    <?php
}

// Menambahkan CSS kustom untuk tombol support di admin head
function cc_support_widgets_custom_css() {
    echo '<style>
        .cc-support-btn {
            transition: all 0.2s ease-in-out !important;
        }
        .cc-support-btn:hover {
            opacity: 0.95 !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
        }
        .cc-support-btn.wa-btn:hover {
            background: #1ebe57 !important;
        }
        .cc-support-btn.site-btn:hover {
            background: #1e293b !important;
        }
    </style>';
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
