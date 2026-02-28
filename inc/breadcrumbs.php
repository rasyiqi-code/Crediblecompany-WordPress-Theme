<?php
/**
 * Helper Fungsi Breadcrumbs (Aman untuk On-Page SEO / Schema)
 *
 * @package CredibleCompany
 */

function cc_breadcrumbs() {
    if ( is_front_page() || is_home() ) {
        return;
    }

    echo '<nav aria-label="Breadcrumb" class="cc-breadcrumbs" style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 15px;">';
    echo '<ol style="list-style: none; padding: 0; margin: 0; display: flex; flex-wrap: wrap; gap: 8px;">';

    // Item 1: Home
    echo '<li style="display: flex; align-items: center;">';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '" style="color: var(--primary-color); text-decoration: none;">Beranda</a>';
    echo '<span style="margin-left: 8px;">/</span>';
    echo '</li>';

    if ( is_category() || is_single() ) {
        // Item 2: Categori
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            echo '<li style="display: flex; align-items: center;">';
            echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" style="color: var(--primary-color); text-decoration: none;">' . esc_html( $categories[0]->name ) . '</a>';
            echo '<span style="margin-left: 8px;">/</span>';
            echo '</li>';
        }

        if ( is_single() ) {
            // Item 3: Current Post
            echo '<li aria-current="page" style="display: flex; align-items: center; color: var(--text-dark); flex: 1; min-width: 0;">';
            echo '<span style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 300px;">' . get_the_title() . '</span>';
            echo '</li>';
        }
    } elseif ( is_page() ) {
        echo '<li aria-current="page" style="display: flex; align-items: center; color: var(--text-dark);">';
        echo '<span>' . get_the_title() . '</span>';
        echo '</li>';
    } 

    echo '</ol>';
    echo '</nav>';
}
