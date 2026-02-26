<?php
/**
 * Table of Contents Generator
 * 
 * Secara otomatis menyisipkan ID ke elemen H2/H3 pada fungsi the_content()
 * dan menghasilkan struktur HTML daftar isi.
 *
 * @package CredibleCompany
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Filter the_content untuk menyisipkan ID ke setiap H2 dan H3
 */
function cc_add_ids_to_headings( $content ) {
    // Hanya proses pada single post
    if ( ! is_single() || ! in_the_loop() || ! is_main_query() ) {
        return $content;
    }

    // Pola regex untuk mencari H2 dan H3
    $pattern = '/<h([2-3])(.*?)>(.*?)<\/h[2-3]>/i';

    $content = preg_replace_callback( $pattern, function( $matches ) {
        $level      = $matches[1];
        $attributes = $matches[2];
        $text       = $matches[3];

        // Jika heading sudah memiliki ID, biarkan saja
        if ( stripos( $attributes, 'id=' ) !== false ) {
            return $matches[0];
        }

        // Buat slug ID dasar dari teks heading
        $slug = sanitize_title_with_dashes( strip_tags( $text ) );
        if ( empty( $slug ) ) {
            $slug = 'heading-' . uniqid();
        }

        return sprintf( '<h%1$s%2$s id="%3$s">%4$s</h%1$s>', $level, $attributes, esc_attr( $slug ), $text );

    }, $content );

    return $content;
}
add_filter( 'the_content', 'cc_add_ids_to_headings' );

/**
 * Fungsi pembantu untuk membuat dan me-*return* HTML struktur Daftar Isi (TOC)
 */
function cc_generate_toc_html( $content ) {
    $pattern = '/<h([2-3]).*?id=[\'"]([^\'"]+)[\'"].*?>(.*?)<\/h[2-3]>/i';
    preg_match_all( $pattern, $content, $matches, PREG_SET_ORDER );

    if ( empty( $matches ) ) {
        return ''; // Tidak ada heading H2/H3 yang ditemukan
    }

    $toc_html = '<nav class="cc-post-toc-navigation">';
    $toc_html .= '<ul class="toc-list">';

    $current_level = 2; // Asumsikan kita mulai dengan H2

    foreach ( $matches as $match ) {
        $level = intval( $match[1] );
        $id    = $match[2];
        $text  = strip_tags( $match[3] );

        // Menyamakan hierarki tingkat heading
        if ( $level > $current_level ) {
            $toc_html .= '<ul class="toc-sublist">';
        } elseif ( $level < $current_level ) {
            // Tutup sublist sebelumnya jika level naik kembali ke H2
            $toc_html .= '</ul></li>';
        } else {
            // Jika level sama, tutup tag <li> sebelumnya
            if ( $match !== reset($matches) && ! str_ends_with($toc_html, 'ul class="toc-sublist">') ) {
                 $toc_html .= '</li>';
            }
        }

        $toc_html .= sprintf(
            '<li class="toc-item toc-level-%d"><a href="#%s" class="toc-link">%s</a>',
            $level,
            esc_attr( $id ),
            esc_html( $text )
        );

        $current_level = $level;
    }

    // Menutup tag terbuka
    while ( $current_level > 2 ) {
        $toc_html .= '</li></ul>';
        $current_level--;
    }
    $toc_html .= '</li>'; // Tutup list item terakhir
    
    $toc_html .= '</ul>';
    $toc_html .= '</nav>';

    return $toc_html;
}
