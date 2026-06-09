<?php
/**
 * Functions utama tema Credible Company.
 * Memuat modul-modul dari folder inc/ dan mendaftarkan fitur tema.
 *
 * @package CredibleCompany
 */

// Sembunyikan Admin Bar di frontend
add_filter( 'show_admin_bar', '__return_false' );

// Deteksi HTTPS dari nama domain produksi atau Reverse Proxy / Load Balancer / Cloudflare untuk mencegah Mixed Content
if (
    ( isset( $_SERVER['HTTP_HOST'] ) && 'publisher.ppns.ac.id' === $_SERVER['HTTP_HOST'] ) ||
    ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' === strtolower( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) ) ||
    ( isset( $_SERVER['HTTP_X_FORWARDED_SSL'] ) && 'on' === strtolower( $_SERVER['HTTP_X_FORWARDED_SSL'] ) ) ||
    ( isset( $_SERVER['HTTP_FRONT_END_HTTPS'] ) && 'on' === strtolower( $_SERVER['HTTP_FRONT_END_HTTPS'] ) ) ||
    ( isset( $_SERVER['HTTP_X_URL_SCHEME'] ) && 'https' === strtolower( $_SERVER['HTTP_X_URL_SCHEME'] ) ) ||
    ( isset( $_SERVER['HTTP_X_FORWARDED_PORT'] ) && '443' == $_SERVER['HTTP_X_FORWARDED_PORT'] )
) {
    $_SERVER['HTTPS'] = 'on';
}

// Filter pengaman tambahan untuk memaksakan skema HTTPS pada semua stylesheet dan script yang dimuat di domain produksi
add_filter( 'style_loader_src', 'cc_force_https_assets', 999 );
add_filter( 'script_loader_src', 'cc_force_https_assets', 999 );
function cc_force_https_assets( $src ) {
    if ( isset( $_SERVER['HTTP_HOST'] ) && 'publisher.ppns.ac.id' === $_SERVER['HTTP_HOST'] ) {
        if ( is_string( $src ) && 0 === strpos( $src, 'http://' ) ) {
            $src = str_replace( 'http://', 'https://', $src );
        }
    }
    return $src;
}

/* --------------------------------------------------------------------------
 * 1. Loader — Muat semua modul dari folder inc/
 *    Urutan penting: helpers & CPT sebelum modul yang bergantung padanya.
 * ---------------------------------------------------------------------- */
$_cc_inc = get_template_directory() . '/inc/';

// Utilitas & asset
require_once $_cc_inc . 'helpers.php';
require_once $_cc_inc . 'enqueue.php';
require_once $_cc_inc . 'breadcrumbs.php';

// Custom Post Types
require_once $_cc_inc . 'cpts/cpt-testimoni.php';
require_once $_cc_inc . 'cpts/cpt-paket-jasa.php';
require_once $_cc_inc . 'cpts/cpt-marketing.php';

// Fitur konten
require_once $_cc_inc . 'post-views.php';
require_once $_cc_inc . 'toc-generator.php';
require_once $_cc_inc . 'custom-comments.php';
require_once $_cc_inc . 'dynamic-wa.php';
require_once $_cc_inc . 'submit-testimoni.php';
require_once $_cc_inc . 'ajax-loadmore.php';

// Customizer (semua panel & settings)
require_once $_cc_inc . 'customizer/loader.php';

// Custom Admin & Login Theme Engine
require_once $_cc_inc . 'admin-theme-engine.php';

// Fitur Whitelabel Dashboard Admin
require_once $_cc_inc . 'admin-whitelabel.php';

// Optimizers (SEO, Keamanan, Performa) — urutan: performance dulu, SEO terakhir
require_once $_cc_inc . 'optimizers/performance-optimizer.php';
require_once $_cc_inc . 'optimizers/security-optimizer.php';
require_once $_cc_inc . 'optimizers/seo-optimizer.php';

unset( $_cc_inc ); // Bersihkan variabel temporary

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
 * 4. Query Modifications
 * ---------------------------------------------------------------------- */

/**
 * Atur jumlah post per halaman untuk arsip testimoni.
 */
add_action( 'pre_get_posts', function ( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'testimoni' ) ) {
        $query->set( 'posts_per_page', 9 );
    }
} );

/* --------------------------------------------------------------------------
 * 5. Routing Dinamis Template
 *    Override WordPress default template hierarchy menggunakan filter.
 *    Semua template full-page berada di folder /templates/.
 * ---------------------------------------------------------------------- */
add_filter( 'template_include', 'cc_resolve_template' );

/**
 * Resolve template dari folder /templates/ berdasarkan kondisi halaman.
 *
 * @param string $template Path template default dari WordPress.
 * @return string Path template yang akan digunakan.
 */
function cc_resolve_template( $template ) {
    $dir = get_template_directory() . '/templates/';

    $map = array(
        'is_404'                  => '404.php',
        'is_search'               => 'search.php',
        'is_front_page'           => 'front-page.php',
        'is_home'                 => 'home.php',
        'is_page'                 => 'page.php',
    );

    // Cek kondisi sederhana (tidak bergantung post type)
    foreach ( $map as $condition => $file ) {
        if ( call_user_func( $condition ) && file_exists( $dir . $file ) ) {
            return $dir . $file;
        }
    }

    // Single post/CPT — coba single-{post_type}.php dulu, fallback ke single.php
    if ( is_single() ) {
        $post_type     = get_post_type();
        $specific_file = "single-{$post_type}.php";
        if ( $post_type && file_exists( $dir . $specific_file ) ) {
            return $dir . $specific_file;
        }
        if ( file_exists( $dir . 'single.php' ) ) {
            return $dir . 'single.php';
        }
    }

    // Archive/Kategori/CPT Archive — coba archive-{post_type}.php dulu
    if ( is_archive() ) {
        $post_type     = get_post_type();
        $specific_file = "archive-{$post_type}.php";
        if ( $post_type && is_post_type_archive( $post_type ) && file_exists( $dir . $specific_file ) ) {
            return $dir . $specific_file;
        }
        if ( file_exists( $dir . 'archive.php' ) ) {
            return $dir . 'archive.php';
        }
    }

    return $template;
}

