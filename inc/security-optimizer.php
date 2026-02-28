<?php
/**
 * Modul Keamanan & Privasi (Pro Privacy)
 * Menangani Custom Login URL, Masking Error, dan Proteksi Data User.
 *
 * @package CredibleCompany
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* --------------------------------------------------------------------------
 * 1. Custom Login URL (Hide wp-login.php)
 * ---------------------------------------------------------------------- */

/**
 * Mendefinisikan slug login kustom.
 * Ganti 'masuk' dengan kata lain jika ingin lebih rahasia.
 */
function cc_get_login_slug() {
    return 'masuk';
}

/**
 * Handle pengalihan dari slug kustom ke wp-login.php dengan kunci rahasia.
 */
add_action( 'init', 'cc_handle_custom_login_redirect' );
function cc_handle_custom_login_redirect() {
    $login_slug = cc_get_login_slug();
    $request_uri = untrailingslashit( $_SERVER['REQUEST_URI'] );
    
    // Jika user mengakses /masuk, arahkan ke wp-login.php dengan token khusus
    if ( $request_uri === '/' . $login_slug ) {
        wp_safe_redirect( site_url( 'wp-login.php?allow_access=true' ) );
        exit;
    }
}

/**
 * Blokir akses langsung ke wp-login.php jika tidak membawa token atau bukan proses POST.
 */
add_action( 'login_init', 'cc_protect_login_page' );
function cc_protect_login_page() {
    // Abaikan jika sedang proses login (POST) atau registrasi/lostpassword yang valid
    if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
        return;
    }

    $allow_access = isset( $_GET['allow_access'] ) && $_GET['allow_access'] === 'true';
    $is_action    = isset( $_GET['action'] ) && in_array( $_GET['action'], array( 'logout', 'lostpassword', 'rp', 'resetpass' ) );

    // Jika mencoba akses langsung tanpa token, lempar ke 404
    if ( ! $allow_access && ! $is_action ) {
        global $wp_query;
        $wp_query->set_404();
        status_header( 404 );
        include( get_query_template( '404' ) );
        exit;
    }
}

/* --------------------------------------------------------------------------
 * 2. Login Error Masking (Keamanan Akun)
 * ---------------------------------------------------------------------- */

add_filter( 'login_errors', 'cc_mask_login_errors' );
function cc_mask_login_errors() {
    return '<strong>Gagal:</strong> Data login yang Anda masukkan tidak valid. Silakan coba lagi.';
}

/* --------------------------------------------------------------------------
 * 3. Proteksi User Enumeration (Cegah Pencarian Username)
 * ---------------------------------------------------------------------- */

add_action( 'template_redirect', 'cc_disable_user_enumeration' );
function cc_disable_user_enumeration() {
    if ( ! is_admin() && isset( $_GET['author'] ) ) {
        wp_safe_redirect( home_url(), 301 );
        exit;
    }
}

// Blokir Rest API User Endpoints (Untuk User Non-Admin)
add_filter( 'rest_prepare_user', function( $response, $user, $request ) {
    if ( ! current_user_can( 'manage_options' ) ) {
        return new WP_Error( 'rest_cannot_read', __( 'Anda tidak memiliki akses.', 'crediblecompany' ), array( 'status' => 403 ) );
    }
    return $response;
}, 10, 3 );

/* --------------------------------------------------------------------------
 * 4. Admin White-labeling (Professional Branding)
 * ---------------------------------------------------------------------- */

// 1. Custom Login Branding (Logo & Style)
add_action( 'login_enqueue_scripts', 'cc_custom_login_branding' );
function cc_custom_login_branding() {
    $logo_url = '';
    if ( has_custom_logo() ) {
        $logo_id = get_theme_mod( 'custom_logo' );
        $logo_data = wp_get_attachment_image_src( $logo_id, 'full' );
        $logo_url = $logo_data[0];
    }
    ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo esc_url( $logo_url ); ?>);
            background-size: contain;
            width: 100%;
            height: 80px;
            margin-bottom: 20px;
        }
        body.login { background: #f8fafc; }
        .login #login_error, .login .message, .login .success { border-left-color: #d4af37; border-radius: 8px; }
        .login form { border-radius: 12px; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); border: none; }
        .wp-core-ui .button-primary { background: #000; border-color: #000; transition: all 0.3s; padding: 0 20px; border-radius: 6px; }
        .wp-core-ui .button-primary:hover { background: #d4af37; border-color: #d4af37; color: #000; }
    </style>
    <?php
}

// Ganti link logo login ke Beranda
add_filter( 'login_headerurl', function() { return home_url(); } );
add_filter( 'login_headertext', function() { return get_bloginfo( 'name' ); } );

// 2. Admin Footer Branding
add_filter( 'admin_footer_text', 'cc_custom_admin_footer' );
function cc_custom_admin_footer() {
    echo '<span id="footer-thankyou">Dashboard Kelola &bull; <strong>' . get_bloginfo( 'name' ) . '</strong></span>';
}
add_filter( 'update_footer', '__return_empty_string', 11 );

// 3. Toolbar Cleaning (Hapus Logo WP)
add_action( 'wp_before_admin_bar_render', 'cc_remove_wp_logo_admin_bar', 0 );
function cc_remove_wp_logo_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'wp-logo' );
    $wp_admin_bar->remove_menu( 'about' );
    $wp_admin_bar->remove_menu( 'wporg' );
    $wp_admin_bar->remove_menu( 'documentation' );
    $wp_admin_bar->remove_menu( 'support-forums' );
    $wp_admin_bar->remove_menu( 'feedback' );
}

// 4. Clean Admin Menu (Sembunyikan Menu Tak Perlu)
add_action( 'admin_menu', 'cc_clean_admin_menu' );
function cc_clean_admin_menu() {
    // Sembunyikan komentar jika tidak dipakai
    // remove_menu_page( 'edit-comments.php' );
    
    // Sembunyikan Dashboard asli (bisa membingungkan klien)
    // remove_menu_page( 'index.php' ); 
}
