<?php
/**
 * Modul Optimasi Performa & Speed Booster (No-Plugin)
 * Menangani Caching, Bloat Removal, Asset Optimization, dan DB Cleanup.
 *
 * @package CredibleCompany
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* --------------------------------------------------------------------------
 * 1. Bloat Removal (Membersihkan Fitur Tak Terpakai)
 * ---------------------------------------------------------------------- */

// Mematikan Emojis
add_action( 'init', 'cc_disable_emojis' );
function cc_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'cc_disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'cc_disable_emojis_remove_dns_prefetch', 10, 2 );
}
function cc_disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
        return array();
    }
}
function cc_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/12.0.0-1/svg/' );
        $urls = array_diff( $urls, array( $emoji_svg_url ) );
    }
    return $urls;
}

// Mematikan oEmbeds (Mencegah request eksternal tambahan)
add_action( 'init', 'cc_disable_oembeds', 9999 );
function cc_disable_oembeds() {
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
}

// Mematikan XML-RPC (Keamanan & Performa)
add_filter( 'xmlrpc_enabled', '__return_false' );

// Mematikan jQuery Migrate (Mengurangi 1 request JS)
add_action( 'wp_default_scripts', 'cc_dequeue_jquery_migrate' );
function cc_dequeue_jquery_migrate( $scripts ) {
    if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
        $jquery_dependencies = $scripts->registered['jquery']->deps;
        $scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array( 'jquery-migrate' ) );
    }
}

// Mematikan Dashicons di Frontend untuk User Non-Login
add_action( 'wp_enqueue_scripts', 'cc_dequeue_dashicons', 100 );
function cc_dequeue_dashicons() {
    if ( ! is_user_logged_in() ) {
        wp_dequeue_style( 'dashicons' );
    }
}

/* --------------------------------------------------------------------------
 * 2. System Control (Limit Revisions & Heartbeat)
 * ---------------------------------------------------------------------- */

// Batasi Revisions (Maksimal 5 untuk hemat database)
if ( ! defined( 'WP_POST_REVISIONS' ) ) {
    define( 'WP_POST_REVISIONS', 5 );
}

// Kontrol Heartbeat API (Hemat Resource CPU Server)
add_action( 'init', 'cc_stop_heartbeat', 1 );
function cc_stop_heartbeat() {
    wp_deregister_script( 'heartbeat' );
}

/* --------------------------------------------------------------------------
 * 3. Asset Optimization (HTML Minify, Defer Scripts)
 * ---------------------------------------------------------------------- */

// Minifikasi HTML (Menghilangkan Whitespace tak perlu)
add_action( 'get_header', 'cc_start_html_minify' );
function cc_start_html_minify() {
    ob_start( 'cc_minify_html_output' );
}
function cc_minify_html_output( $buffer ) {
    if ( ! is_admin() && strpos( $buffer, '<pre' ) === false && strpos( $buffer, '<textarea' ) === false ) {
        $search = array(
            '/\>[^\S ]+/s',     // Menghilangkan space setelah tag
            '/[^\S ]+\</s',     // Menghilangkan space sebelum tag
            '/(\s)+/s',         // Menghilangkan tab/newline ganda
            '/<!--(.|\s)*?-->/' // Menghilangkan komentar HTML (kecuali IE conditional)
        );
        $replace = array( '>', '<', '\\1', '' );
        $buffer = preg_replace( $search, $replace, $buffer );
    }
    return $buffer;
}

// Menambahkan atribut Defer ke Script (Non-Kritikal)
add_filter( 'script_loader_tag', 'cc_defer_scripts', 10, 3 );
function cc_defer_scripts( $tag, $handle, $src ) {
    // Abaikan di admin, customizer preview, atau untuk jQuery inti agar tidak merusak inline script
    if ( is_admin() || is_customize_preview() || 'jquery' === $handle || 'jquery-core' === $handle ) {
        return $tag;
    }
    return str_replace( ' src', ' defer src', $tag );
}

/* --------------------------------------------------------------------------
 * 4. Media & Font Optimization (Lazy Load iFrame & Fonts)
 * ---------------------------------------------------------------------- */

// Lazy Load iFrames & YouTube Videos
add_filter( 'the_content', 'cc_lazy_load_iframes' );
function cc_lazy_load_iframes( $content ) {
    if ( ! is_admin() ) {
        $content = str_replace( '<iframe', '<iframe loading="lazy"', $content );
    }
    return $content;
}

// Optimasi Font (Swap Display)
add_filter( 'style_loader_tag', 'cc_font_display_swap', 10, 2 );
function cc_font_display_swap( $tag, $handle ) {
    if ( strpos( $tag, 'fonts.googleapis.com' ) !== false && strpos( $tag, 'display=swap' ) === false ) {
        // Tentukan separator (? atau &) berdasarkan keberadaan query string
        $sep = ( strpos( $tag, '?' ) !== false ) ? '&' : '?';
        // Injeksi parameter hanya ke dalam atribut href
        $tag = preg_replace( '/href=(["\'])(.*?)\1/', 'href=$1$2' . $sep . 'display=swap$1', $tag );
    }
    return $tag;
}

// Preload Logo & Featured Image Beranda
add_action( 'wp_head', 'cc_preload_critical_assets', 1 );
function cc_preload_critical_assets() {
    // Preload Logo
    if ( has_custom_logo() ) {
        $logo_id = get_theme_mod( 'custom_logo' );
        $logo_url = wp_get_attachment_image_src( $logo_id, 'full' );
        if ( $logo_url ) {
            echo '<link rel="preload" as="image" href="' . esc_url( $logo_url[0] ) . '">' . "\n";
        }
    }

    // Preload Featured Image di Single Post
    if ( is_singular() && has_post_thumbnail() ) {
        $img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
        if ( $img_url ) {
            echo '<link rel="preload" as="image" href="' . esc_url( $img_url ) . '">' . "\n";
        }
    }
}

/* --------------------------------------------------------------------------
 * 5. Database & System Housekeeping (Auto Cleanup)
 * ---------------------------------------------------------------------- */

// Jadwal Pembersihan Mingguan via WP Cron
if ( ! wp_next_scheduled( 'cc_weekly_db_cleanup' ) ) {
    wp_schedule_event( time(), 'weekly', 'cc_weekly_db_cleanup' );
}

add_action( 'cc_weekly_db_cleanup', 'cc_perform_db_cleanup' );
function cc_perform_db_cleanup() {
    global $wpdb;

    // 1. Bersihkan Transients yang kadaluarsa
    $wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_%' AND option_value < " . time() );
    $wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_%' AND option_name NOT LIKE '_transient_timeout_%'" );

    // 2. Bersihkan Auto-Drafts lama (> 7 hari)
    $wpdb->query( "DELETE FROM $wpdb->posts WHERE post_status = 'auto-draft' AND post_date < DATE_SUB(NOW(), INTERVAL 7 DAY)" );

    // 3. Optimasi Tabel (Hanya untuk tabel inti)
    $wpdb->query( "OPTIMIZE TABLE $wpdb->posts, $wpdb->postmeta, $wpdb->options, $wpdb->comments, $wpdb->commentmeta" );
}

/* --------------------------------------------------------------------------
 * 6. Simple Page Caching (PHP-based File Cache)
 * ---------------------------------------------------------------------- */

add_action( 'template_redirect', 'cc_auto_page_cache_start', 1 );
function cc_auto_page_cache_start() {
    // Jangan cache untuk user login, admin, atau request POST/Search
    if ( is_user_logged_in() || is_admin() || ! empty( $_POST ) || is_search() ) {
        return;
    }

    $cache_dir       = WP_CONTENT_DIR . '/cache/cc-cache/';
    $marketer_cookie = defined( 'CC_MARKETER_COOKIE' ) ? CC_MARKETER_COOKIE : 'cc_marketer_ref';
    $marketer_id     = isset( $_COOKIE[ $marketer_cookie ] ) ? intval( $_COOKIE[ $marketer_cookie ] ) : 0;
    
    // Cache key dikombinasikan dengan ID marketer aktif agar tidak terjadi salah saji (cache poisoning)
    $cache_key  = md5( $_SERVER['REQUEST_URI'] . '_' . $marketer_id );
    $cache_file = $cache_dir . $cache_key . '.html';

    // Buat folder jika belum ada
    if ( ! is_dir( $cache_dir ) ) {
        wp_mkdir_p( $cache_dir );
    }

    // Buat file index.php kosong untuk mencegah listing direktori jika belum ada
    $index_file = $cache_dir . 'index.php';
    if ( ! file_exists( $index_file ) ) {
        file_put_contents( $index_file, "<?php\n// Silence is golden.\n" );
    }

    // Jika file cache ada dan masih segar (< 24 jam), sajikan langsung
    if ( file_exists( $cache_file ) && ( time() - filemtime( $cache_file ) < 86400 ) ) {
        readfile( $cache_file );
        echo "\n<!-- Served from CC Cache / " . date( 'Y-m-d H:i:s', filemtime( $cache_file ) ) . " -->";
        exit;
    }

    // Mulai buffer untuk menyimpan hasil render
    ob_start( function( $buffer ) use ( $cache_file ) {
        if ( ! empty( $buffer ) && strlen( $buffer ) > 1000 ) { // Hanya simpan jika buffer valid
            file_put_contents( $cache_file, $buffer );
        }
        return $buffer;
    });
}

/**
 * Bersihkan semua file cache halaman (.html) jika ada perubahan di Customizer atau konten baru.
 */
function cc_clear_all_page_cache() {
    $cache_dir = WP_CONTENT_DIR . '/cache/cc-cache/';
    if ( is_dir( $cache_dir ) ) {
        $files = glob( $cache_dir . '*.html' );
        if ( is_array( $files ) ) {
            foreach ( $files as $file ) {
                if ( is_file( $file ) ) {
                    unlink( $file );
                }
            }
        }
    }
}
add_action( 'customize_save_after', 'cc_clear_all_page_cache' );
add_action( 'save_post', 'cc_clear_all_page_cache' );
add_action( 'activated_plugin', 'cc_clear_all_page_cache' );
add_action( 'deactivated_plugin', 'cc_clear_all_page_cache' );
add_action( 'switch_theme', 'cc_clear_all_page_cache' );

/* --------------------------------------------------------------------------
 * 7. Media Storage Optimization (Mencegah Boros Disk Space)
 *    Hanya simpan gambar asli, matikan semua resize dan hapus ukuran tambahan.
 * ---------------------------------------------------------------------- */

// 1. Menonaktifkan ukuran gambar bawaan WordPress
add_filter( 'intermediate_image_sizes_advanced', 'cc_disable_image_sizes' );
function cc_disable_image_sizes( $sizes ) {
    unset( $sizes['thumbnail'] );
    unset( $sizes['medium'] );
    unset( $sizes['large'] );
    unset( $sizes['medium_large'] );
    unset( $sizes['1536x1536'] );
    unset( $sizes['2048x2048'] );
    return $sizes;
}

// 2. Menonaktifkan threshold penskalaan gambar besar agar tidak ada versi -scaled
add_filter( 'big_image_size_threshold', '__return_false' );

// 3. Menonaktifkan ukuran gambar post-thumbnail bawaan tema/plugin
add_action( 'init', 'cc_disable_other_image_sizes' );
function cc_disable_other_image_sizes() {
    remove_image_size( 'post-thumbnail' );
}

// 4. Menonaktifkan semua ukuran gambar kustom tambahan dari tema/plugin lain
add_action( 'init', 'cc_disable_custom_image_sizes', 999 );
function cc_disable_custom_image_sizes() {
    global $_wp_additional_image_sizes;
    if ( isset( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
        foreach ( $_wp_additional_image_sizes as $size => $details ) {
            remove_image_size( $size );
        }
    }
}

// 5. Override downsize: Selalu arahkan panggilan ukuran kustom ke gambar asli
add_filter( 'image_downsize', 'cc_disable_image_downsize', 10, 3 );
function cc_disable_image_downsize( $downsize, $id, $size ) {
    if ( 'full' === $size ) {
        return false;
    }
    
    $img_url = wp_get_attachment_url( $id );
    $meta    = wp_get_attachment_metadata( $id );
    
    if ( ! $img_url ) {
        return false;
    }
    
    $width  = isset( $meta['width'] ) ? $meta['width'] : 0;
    $height = isset( $meta['height'] ) ? $meta['height'] : 0;
    
    // Kembalikan URL gambar asli
    return array( $img_url, $width, $height, false );
}

// 6. Hapus secara fisik file gambar tambahan hasil resize jika terlanjur di-generate saat upload
add_filter( 'wp_generate_attachment_metadata', 'cc_delete_additional_image_sizes' );
function cc_delete_additional_image_sizes( $metadata ) {
    if ( empty( $metadata['file'] ) ) {
        return $metadata;
    }

    $upload_dir = wp_upload_dir();
    $base_dir   = $upload_dir['basedir'];
    $file_path  = $base_dir . '/' . $metadata['file'];

    $path_info = pathinfo( $file_path );
    $directory = $path_info['dirname'];
    $filename  = $path_info['filename'];

    // Cari file sejenis di folder uploads
    $all_files = glob( $directory . '/*' );
    if ( is_array( $all_files ) ) {
        foreach ( $all_files as $file ) {
            // Hapus file yang mengandung nama file asli tetapi bukan file aslinya sendiri
            if ( strpos( $file, $filename ) !== false && $file !== $file_path ) {
                @unlink( $file );
            }
        }
    }

    // Bersihkan metadata sizes agar WordPress tidak merujuk ke file yang sudah dihapus
    if ( isset( $metadata['sizes'] ) ) {
        $metadata['sizes'] = array();
    }

    return $metadata;
}

