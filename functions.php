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
require_once get_template_directory() . '/inc/cpts/cpt-paket-jasa.php';
require_once get_template_directory() . '/inc/cpts/cpt-testimoni.php';
require_once get_template_directory() . '/inc/cpts/cpt-marketing.php';
require_once get_template_directory() . '/inc/custom-comments.php';
require_once get_template_directory() . '/inc/toc-generator.php';
require_once get_template_directory() . '/inc/dynamic-wa.php';
require_once get_template_directory() . '/inc/optimizers/performance-optimizer.php';
require_once get_template_directory() . '/inc/optimizers/security-optimizer.php';

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
 *    Pecah ke berkas modular: inc/submit-testimoni.php
 * ---------------------------------------------------------------------- */
require_once get_template_directory() . '/inc/submit-testimoni.php';

/**
 * Atur jumlah post per halaman untuk arsip testimoni.
 */
add_action( 'pre_get_posts', function ( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'testimoni' ) ) {
        $query->set( 'posts_per_page', 9 );
    }
} );

require_once get_template_directory() . '/inc/breadcrumbs.php';
require_once get_template_directory() . '/inc/optimizers/seo-optimizer.php';

/* --------------------------------------------------------------------------
 * 5. Routing Dinamis Template Opsional
 * ---------------------------------------------------------------------- */
add_filter( 'template_include', function ( $template ) {
    $templates_dir = get_template_directory() . '/templates/';

    // 1. Halaman 404
    if ( is_404() && file_exists( $templates_dir . '404.php' ) ) {
        return $templates_dir . '404.php';
    }

    // 2. Halaman Pencarian
    if ( is_search() && file_exists( $templates_dir . 'search.php' ) ) {
        return $templates_dir . 'search.php';
    }

    // 3. Halaman Depan Utama (Front Page)
    if ( is_front_page() && file_exists( $templates_dir . 'front-page.php' ) ) {
        return $templates_dir . 'front-page.php';
    }

    // 4. Halaman Blog Index (Home)
    if ( is_home() && file_exists( $templates_dir . 'home.php' ) ) {
        return $templates_dir . 'home.php';
    }

    // 5. Halaman Single Post / Custom Post Type tunggal
    if ( is_single() ) {
        $post_type = get_post_type();
        if ( $post_type && file_exists( $templates_dir . "single-{$post_type}.php" ) ) {
            return $templates_dir . "single-{$post_type}.php";
        }
        if ( file_exists( $templates_dir . 'single.php' ) ) {
            return $templates_dir . 'single.php';
        }
    }

    // 6. Halaman Statis (Page)
    if ( is_page() && file_exists( $templates_dir . 'page.php' ) ) {
        return $templates_dir . 'page.php';
    }

    // 7. Halaman Arsip / Kategori / CPT Archive
    if ( is_archive() ) {
        $post_type = get_post_type();
        if ( $post_type && is_post_type_archive( $post_type ) && file_exists( $templates_dir . "archive-{$post_type}.php" ) ) {
            return $templates_dir . "archive-{$post_type}.php";
        }
        if ( file_exists( $templates_dir . 'archive.php' ) ) {
            return $templates_dir . 'archive.php';
        }
    }

    return $template;
} );
