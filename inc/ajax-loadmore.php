<?php
/**
 * AJAX Load More Handler
 * Menangani permintaan pemuatan postingan tambahan via AJAX.
 *
 * @package CredibleCompany
 */

add_action( 'wp_ajax_cc_load_more', 'cc_ajax_load_more_handler' );
add_action( 'wp_ajax_nopriv_cc_load_more', 'cc_ajax_load_more_handler' );

function cc_ajax_load_more_handler() {
    $paged     = isset( $_POST['page'] ) ? intval( $_POST['page'] ) + 1 : 1;
    $post_type = isset( $_POST['post_type'] ) ? sanitize_text_field( $_POST['post_type'] ) : 'post';
    $orderby   = isset( $_POST['orderby'] ) ? sanitize_text_field( $_POST['orderby'] ) : 'date';
    $exclude   = isset( $_POST['exclude'] ) ? intval( $_POST['exclude'] ) : 0;

    $ppp = 9;
    $offset = 0;

    if ( 'post' === $post_type ) {
        // Halaman 1 memuat 10 post (1 Featured + 9 Grid)
        // Halaman 2+ memuat 9 post
        if ( $paged > 1 ) {
            $offset = ( ($paged - 2) * 9 ) + 10;
        }
    }

    if ( 'testimoni' === $post_type && $exclude ) {
        $ppp = 4; // Konsisten dengan limit testimoni lainnya
    }

    $args = array(
        'post_type'      => $post_type,
        'posts_per_page' => $ppp,
        'offset'         => $offset,
        'post_status'    => 'publish',
    );

    if ( $exclude ) {
        $args['post__not_in'] = array( $exclude );
    }

    if ( 'popular' === $orderby ) {
        $args['meta_key'] = 'cc_post_views';
        $args['orderby']  = 'meta_value_num';
        $args['order']    = 'DESC';
    } else {
        $args['orderby']  = 'date';
        $args['order']    = 'DESC';
    }

    $query = new WP_Query( $args );

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            
            if ( 'testimoni' === $post_type ) {
                get_template_part( 'template-parts/card-testimoni', null, array( 'is_link' => true ) );
            } else {
                // Untuk blog di halaman index (home.php) menggunakan style 'app'
                get_template_part( 'template-parts/card-post', null, array( 'style' => 'app' ) );
            }
        }
    }

    wp_reset_postdata();
    wp_die();
}
