<?php
/**
 * Engine Kustomisasi Halaman Login & Dashboard Admin (WP Admin) secara otomatis.
 * Komentar di kode menggunakan bahasa Indonesia.
 *
 * @package CredibleCompany
 */

// Mencegah akses langsung
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Cek apakah fitur tema admin kustom diaktifkan oleh user
if ( ! get_theme_mod( 'cc_enable_admin_theme', false ) ) {
    return;
}

/**
 * Mendapatkan warna primer tema secara dinamis dari Customizer.
 * Digunakan untuk aksen tombol login, menu aktif, hover sidebar, dll.
 *
 * @return string Kode warna Hex.
 */
function cc_get_admin_primary_color() {
    $header_style = get_theme_mod( 'cc_header_style', 'classic' );
    $primary      = '#c01314'; // Fallback default (merah brand)

    if ( 'classic' === $header_style ) {
        $primary = get_theme_mod( 'cc_header_classic_bg_color', '#c01314' );
    } elseif ( 'centered' === $header_style ) {
        $primary = get_theme_mod( 'cc_header_centered_bg_color', '#c01314' );
    } else {
        $primary = get_theme_mod( 'cc_header_glass_bg_color', '#ffffff' );
    }

    // Jika warna terlalu terang/putih, gunakan fallback merah agar tombol tetap kontras dan terbaca
    if ( in_array( strtolower( $primary ), array( '#ffffff', '#fff', '#f8fafc', '#f1f5f9' ), true ) ) {
        $primary = '#c01314';
    }

    return $primary;
}

/**
 * Mendapatkan warna latar belakang gelap tema dari Customizer (warna footer).
 * Digunakan untuk latar belakang sidebar admin dan admin bar.
 *
 * @return string Kode warna Hex.
 */
function cc_get_admin_dark_color() {
    return get_theme_mod( 'cc_footer_bg_color', '#0b1c3f' );
}

/**
 * Helper untuk menghitung warna yang lebih gelap (darken) untuk hover state tombol.
 *
 * @param string $hex Warna hex asal.
 * @param int    $percent Persentase penggelapan (1-100).
 * @return string Warna hex yang lebih gelap.
 */
function cc_admin_color_darken( $hex, $percent ) {
    $hex = str_replace( '#', '', $hex );
    if ( strlen( $hex ) == 3 ) {
        $hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
    }
    $r = hexdec( substr( $hex, 0, 2 ) );
    $g = hexdec( substr( $hex, 2, 2 ) );
    $b = hexdec( substr( $hex, 4, 2 ) );

    $r = max( 0, min( 255, $r - ( $r * ( $percent / 100 ) ) ) );
    $g = max( 0, min( 255, $g - ( $g * ( $percent / 100 ) ) ) );
    $b = max( 0, min( 255, $b - ( $b * ( $percent / 100 ) ) ) );

    return sprintf( '#%02x%02x%02x', $r, $g, $b );
}

/* --------------------------------------------------------------------------
 * 1. Kustomisasi Halaman Login WordPress
 * ---------------------------------------------------------------------- */

// Ganti tautan URL logo halaman login ke homepage situs
add_filter( 'login_headerurl', function() {
    return home_url();
} );

// Ganti alt text/title logo halaman login ke nama situs
add_filter( 'login_headertext', function() {
    return get_bloginfo( 'name' );
} );

// Suntikkan CSS kustom untuk halaman login agar tampil modern & premium
add_action( 'login_enqueue_scripts', function() {
    $primary_color = cc_get_admin_primary_color();
    $hover_color   = cc_admin_color_darken( $primary_color, 15 );
    $logo_id       = get_theme_mod( 'custom_logo' );
    $logo_url      = '';

    if ( $logo_id ) {
        $logo_data = wp_get_attachment_image_src( $logo_id, 'full' );
        if ( $logo_data ) {
            $logo_url = $logo_data[0];
        }
    }
    ?>
    <style type="text/css">
        body.login {
            background-color: #f8fafc !important;
            background-image: radial-gradient(circle at 10% 20%, rgba(244, 246, 249, 1) 0%, rgba(230, 235, 243, 0.7) 90.1%) !important;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif !important;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        #login {
            padding: 40px 0 0 0 !important;
            margin: auto !important;
            width: 360px !important;
        }
        .login h1 a {
            <?php if ( $logo_url ) : ?>
                background-image: url('<?php echo esc_url( $logo_url ); ?>') !important;
                background-size: contain !important;
                background-position: center !important;
                width: 100% !important;
                height: 70px !important;
                margin-bottom: 30px !important;
            <?php else : ?>
                background-image: none !important;
                text-indent: 0 !important;
                width: auto !important;
                height: auto !important;
                font-size: 28px !important;
                font-weight: 800 !important;
                color: #0f172a !important;
                text-decoration: none !important;
                text-align: center !important;
                display: block !important;
                letter-spacing: -0.5px !important;
                margin-bottom: 25px !important;
            <?php endif; ?>
        }
        .login form {
            background: #ffffff !important;
            border: 1px solid rgba(226, 232, 240, 0.8) !important;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05) !important;
            border-radius: 16px !important;
            padding: 30px 25px !important;
        }
        .login label {
            color: #475569 !important;
            font-weight: 500 !important;
            font-size: 13px !important;
        }
        .login input[type="text"],
        .login input[type="password"] {
            background: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 8px !important;
            padding: 8px 12px !important;
            font-size: 15px !important;
            color: #1e293b !important;
            transition: all 0.2s ease-in-out !important;
            box-shadow: none !important;
        }
        .login input[type="text"]:focus,
        .login input[type="password"]:focus {
            border-color: <?php echo esc_attr( $primary_color ); ?> !important;
            box-shadow: 0 0 0 3px <?php echo esc_attr( cc_hex_to_rgba( $primary_color, 0.15 ) ); ?> !important;
            background: #ffffff !important;
        }
        .login input[type="checkbox"] {
            border: 1px solid #cbd5e1 !important;
            border-radius: 4px !important;
        }
        .login input[type="checkbox"]:checked {
            background: <?php echo esc_attr( $primary_color ); ?> !important;
            border-color: <?php echo esc_attr( $primary_color ); ?> !important;
        }
        .login input[type="checkbox"]:focus {
            box-shadow: 0 0 0 2px <?php echo esc_attr( cc_hex_to_rgba( $primary_color, 0.15 ) ); ?> !important;
        }
        .wp-core-ui .button-primary {
            background: <?php echo esc_attr( $primary_color ); ?> !important;
            border-color: <?php echo esc_attr( $primary_color ); ?> !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
            color: #ffffff !important;
            font-weight: 600 !important;
            font-size: 14px !important;
            height: auto !important;
            padding: 8px 20px !important;
            line-height: 1.5 !important;
            transition: all 0.2s ease-in-out !important;
            width: 100% !important;
            margin-top: 10px !important;
            float: none !important;
            text-shadow: none !important;
        }
        .wp-core-ui .button-primary:hover,
        .wp-core-ui .button-primary:focus {
            background: <?php echo esc_attr( $hover_color ); ?> !important;
            border-color: <?php echo esc_attr( $hover_color ); ?> !important;
            box-shadow: 0 6px 8px -1px rgba(0, 0, 0, 0.12), 0 0 0 3px <?php echo esc_attr( cc_hex_to_rgba( $primary_color, 0.25 ) ); ?> !important;
        }
        .login #nav,
        .login #backtoblog {
            text-align: center !important;
            padding: 0 !important;
            margin: 15px 0 0 0 !important;
        }
        .login #nav a,
        .login #backtoblog a {
            color: #64748b !important;
            font-size: 13px !important;
            transition: color 0.2s !important;
        }
        .login #nav a:hover,
        .login #backtoblog a:hover {
            color: <?php echo esc_attr( $primary_color ); ?> !important;
        }
        .privacy-policy-page-link {
            text-align: center !important;
            margin-top: 25px !important;
        }
        .privacy-policy-page-link a {
            color: #94a3b8 !important;
            font-size: 12px !important;
            text-decoration: none !important;
        }
        .privacy-policy-page-link a:hover {
            color: <?php echo esc_attr( $primary_color ); ?> !important;
        }
    </style>
    <?php
} );

/* --------------------------------------------------------------------------
 * 2. Kustomisasi Dashboard Admin (WP Admin)
 * ---------------------------------------------------------------------- */

// Suntikkan CSS kustom untuk mengubah warna dashboard admin
add_action( 'admin_head', function() {
    $primary_color = cc_get_admin_primary_color();
    $dark_bg       = cc_get_admin_dark_color();
    
    // Hitung variasi warna untuk menu aktif, hover, dan submenu
    $hover_bg      = cc_admin_color_darken( $dark_bg, 10 );
    $active_border = $primary_color;
    $submenu_bg    = cc_admin_color_darken( $dark_bg, 15 );
    ?>
    <style type="text/css">
        /* Latar Belakang Utama Sidebar Menu Admin */
        #adminmenuback,
        #adminmenuwrap,
        #adminmenu {
            background-color: <?php echo esc_attr( $dark_bg ); ?> !important;
        }

        /* Styling Item Menu Utama */
        #adminmenu a {
            color: rgba(255, 255, 255, 0.75) !important;
            transition: all 0.15s ease-in-out;
        }

        #adminmenu div.wp-menu-image:before {
            color: rgba(255, 255, 255, 0.6) !important;
            transition: all 0.15s ease-in-out;
        }

        /* Hover State Menu Utama */
        #adminmenu li.menu-top:hover,
        #adminmenu li.opensub > a.menu-top,
        #adminmenu li.menu-top:focus {
            background-color: <?php echo esc_attr( $hover_bg ); ?> !important;
        }

        #adminmenu li.menu-top:hover a,
        #adminmenu li.menu-top:hover div.wp-menu-image:before {
            color: #ffffff !important;
        }

        /* Active State Menu Utama */
        #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu,
        #adminmenu li.current a.menu-top,
        .folded #adminmenu li.wp-has-current-submenu,
        #adminmenu li.wp-has-current-submenu .wp-submenu .wp-submenu-head {
            background-color: <?php echo esc_attr( $primary_color ); ?> !important;
            color: #ffffff !important;
        }

        #adminmenu li.wp-has-current-submenu div.wp-menu-image:before,
        #adminmenu li.current div.wp-menu-image:before {
            color: #ffffff !important;
        }

        /* Submenu Wrapper */
        #adminmenu .wp-submenu,
        #adminmenu .wp-has-current-submenu .wp-submenu {
            background-color: <?php echo esc_attr( $submenu_bg ); ?> !important;
        }

        #adminmenu .wp-submenu a {
            color: rgba(255, 255, 255, 0.65) !important;
        }

        #adminmenu .wp-submenu a:hover,
        #adminmenu .wp-submenu a:focus {
            color: #ffffff !important;
        }

        #adminmenu .wp-submenu li.current a {
            color: <?php echo esc_attr( $primary_color ); ?> !important;
            font-weight: 600 !important;
        }

        /* Indikator Garis Aktif di Sisi Kiri */
        #adminmenu li.wp-has-current-submenu.wp-menu-open {
            border-left: 4px solid <?php echo esc_attr( $active_border ); ?>;
        }
        #adminmenu li.menu-top {
            border-left: 4px solid transparent;
        }
        #adminmenu li.menu-top:hover {
            border-left-color: <?php echo esc_attr( $primary_color ); ?>;
        }

        /* Collapse Menu Toggle Button */
        #collapse-button {
            color: rgba(255, 255, 255, 0.6) !important;
        }
        #collapse-button:hover {
            color: #ffffff !important;
            background: <?php echo esc_attr( $hover_bg ); ?> !important;
        }

        /* === ADMIN BAR (TOP BAR) STYLING === */
        #wpadminbar {
            background: <?php echo esc_attr( $dark_bg ); ?> !important;
        }
        #wpadminbar .ab-item,
        #wpadminbar a.ab-item,
        #wpadminbar .ab-empty-item {
            color: rgba(255, 255, 255, 0.8) !important;
        }
        #wpadminbar a.ab-item:hover,
        #wpadminbar .ab-item:hover {
            background: <?php echo esc_attr( $primary_color ); ?> !important;
            color: #ffffff !important;
        }
        #wpadminbar .ab-top-menu > li.hover > .ab-item,
        #wpadminbar.nojq .quicklinks .ab-top-menu > li > a:focus,
        #wpadminbar-nojs .ab-top-menu > li.hover > .ab-item {
            background: <?php echo esc_attr( $primary_color ); ?> !important;
            color: #ffffff !important;
        }

        /* Ganti warna badge pembaruan/notifikasi */
        #adminmenu .update-plugins,
        #adminmenu .pending-count,
        #wpadminbar .ab-label,
        #wpadminbar .ab-icon {
            transition: all 0.15s ease-in-out;
        }
        
        /* === CORE BUTTON PRIMARY OVERRIDES === */
        .wp-core-ui .button-primary {
            background: <?php echo esc_attr( $primary_color ); ?> !important;
            border-color: <?php echo esc_attr( $primary_color ); ?> !important;
            color: #ffffff !important;
            text-shadow: none !important;
            box-shadow: 0 1px 0 <?php echo esc_attr( cc_admin_color_darken( $primary_color, 10 ) ); ?> !important;
        }
        .wp-core-ui .button-primary:hover,
        .wp-core-ui .button-primary:focus {
            background: <?php echo esc_attr( cc_admin_color_darken( $primary_color, 10 ) ); ?> !important;
            border-color: <?php echo esc_attr( cc_admin_color_darken( $primary_color, 15 ) ); ?> !important;
            color: #ffffff !important;
        }
    </style>
    <?php
} );

// Mengubah teks footer kiri admin WordPress
add_filter( 'admin_footer_text', function() {
    return sprintf(
        /* translators: %s: site name */
        __( 'Terima kasih telah menggunakan tema <strong>%s</strong>.', 'crediblecompany' ),
        esc_html( get_bloginfo( 'name' ) )
    );
} );

// Menyembunyikan versi WordPress di footer kanan admin
add_filter( 'update_footer', '__return_empty_string', 11 );
