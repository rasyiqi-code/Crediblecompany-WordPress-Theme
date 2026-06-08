<?php
/**
 * Customizer: Hero Section - Suntikkan Variabel CSS Dinamis ke Header
 *
 * @package CredibleCompany
 */

// Mencegah akses langsung
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_head', 'cc_hero_dynamic_css_variables', 100 );
function cc_hero_dynamic_css_variables() {
    // --- AMBIL NILAI HERO V1 ---
    $v1_pad_top    = cc_get( 'hero_v1_padding_top_px', 96 );
    $v1_pad_bottom = cc_get( 'hero_v1_padding_bottom_px', 64 );
    $v1_title_size = cc_get( 'hero_v1_title_size_px', 56 );
    $v1_title_marg = cc_get( 'hero_v1_title_margin_bottom_px', 24 );
    $v1_desc_size  = cc_get( 'hero_v1_desc_size_px', 18 );
    $v1_desc_marg  = cc_get( 'hero_v1_desc_margin_bottom_px', 40 );

    $v1_btn1_bg    = cc_get( 'hero_v1_btn1_bg_color', '#1d4ed8' );
    $v1_btn1_txt   = cc_get( 'hero_v1_btn1_text_color', '#ffffff' );
    $v1_btn2_bg    = cc_get( 'hero_v1_btn2_bg_color', 'transparent' );
    $v1_btn2_txt   = cc_get( 'hero_v1_btn2_text_color', '#1d4ed8' );
    $v1_btn_shape  = cc_get( 'hero_v1_btn_shape', '50px' );

    $v1_shape_main   = cc_get( 'hero_v1_shape_main_color', '#ea580c' );
    $v1_shape_yellow = cc_get( 'hero_v1_shape_yellow_color', '#EAB308' );
    $v1_shape_blue   = cc_get( 'hero_v1_shape_blue_color', '#3B82F6' );
    $v1_shape_red    = cc_get( 'hero_v1_shape_red_color', '#EF4444' );
    $v1_shape_purple = cc_get( 'hero_v1_shape_purple_color', '#8B5CF6' );

    $v1_stat_num   = cc_get( 'hero_v1_stat_number_color', '#F59E0B' );
    $v1_stat_label = cc_get( 'hero_v1_stat_label_color', '#1e293b' );

    // --- AMBIL NILAI HERO V2 ---
    $v2_pad_top    = cc_get( 'hero_v2_padding_top_px', 128 );
    $v2_pad_bottom = cc_get( 'hero_v2_padding_bottom_px', 96 );
    $v2_title_size = cc_get( 'hero_v2_title_size_px', 64 );
    $v2_title_marg = cc_get( 'hero_v2_title_margin_bottom_px', 24 );
    $v2_desc_size  = cc_get( 'hero_v2_desc_size_px', 20 );
    $v2_desc_marg  = cc_get( 'hero_v2_desc_margin_bottom_px', 48 );

    $v2_btn1_bg    = cc_get( 'hero_v2_btn1_bg_color', '#1d4ed8' );
    $v2_btn1_txt   = cc_get( 'hero_v2_btn1_text_color', '#ffffff' );
    $v2_btn2_bg    = cc_get( 'hero_v2_btn2_bg_color', 'transparent' );
    $v2_btn2_txt   = cc_get( 'hero_v2_btn2_text_color', '#1d4ed8' );
    $v2_btn_shape  = cc_get( 'hero_v2_btn_shape', '50px' );

    $v2_glow_1       = cc_get( 'hero_v2_glow_color_1', '#3B82F6' );
    $v2_glow_2       = cc_get( 'hero_v2_glow_color_2', '#8B5CF6' );
    $v2_shape_red    = cc_get( 'hero_v2_shape_red_color', '#EF4444' );
    $v2_shape_purple = cc_get( 'hero_v2_shape_purple_color', '#8B5CF6' );
    $v2_shape_yellow = cc_get( 'hero_v2_shape_yellow_color', '#EAB308' );
    $v2_shape_blue   = cc_get( 'hero_v2_shape_blue_color', '#3B82F6' );

    $v2_stat_num   = cc_get( 'hero_v2_stat_number_color', '#F59E0B' );
    $v2_stat_label = cc_get( 'hero_v2_stat_label_color', '#64748b' );

    // --- AMBIL NILAI HERO V3 ---
    $v3_pad_top    = cc_get( 'hero_v3_padding_top_px', 96 );
    $v3_pad_bottom = cc_get( 'hero_v3_padding_bottom_px', 144 ); // Default baru disesuaikan
    $v3_title_size = cc_get( 'hero_v3_title_size_px', 72 );
    $v3_title_marg = cc_get( 'hero_v3_title_margin_bottom_px', 32 );
    $v3_desc_size  = cc_get( 'hero_v3_desc_size_px', 20 );
    $v3_desc_marg  = cc_get( 'hero_v3_desc_margin_bottom_px', 56 );

    $v3_card_radius   = cc_get( 'hero_v3_card_radius_px', 16 );
    $v3_canvas_radius = cc_get( 'hero_v3_canvas_radius_px', 24 );

    $v3_btn1_bg    = cc_get( 'hero_v3_btn1_bg_color', 'transparent' );
    $v3_btn1_txt   = cc_get( 'hero_v3_btn1_text_color', '#1f2937' ); // Default warna teks gelap
    $v3_btn2_bg    = cc_get( 'hero_v3_btn2_bg_color', '#c01314' ); // Default warna brand merah
    $v3_btn2_txt   = cc_get( 'hero_v3_btn2_text_color', '#ffffff' );
    $v3_btn_shape  = cc_get( 'hero_v3_btn_shape', '8px' ); // Default kelengkungan minimalis 8px

    $v3_canvas_bg     = cc_get( 'hero_v3_canvas_bg', '#00df89' );
    $v3_triangle      = cc_get( 'hero_v3_triangle_color', '#f472b6' );
    $v3_card_right_bg = cc_get( 'hero_v3_card_right_bg', '#0b1c3f' );
    $v3_circle        = cc_get( 'hero_v3_circle_color', '#047857' );
    $v3_blue_bars     = cc_get( 'hero_v3_blue_bars_color', '#3b82f6' );

    // --- GLOBAL ---
    $title_weight  = cc_get( 'hero_title_weight', '900' );
    ?>
    <style type="text/css" id="cc-hero-dynamic-variables">
        :root {
            /* === VARIAN 1 (DEFAULT) === */
            --cc-hero-v1-padding-top: <?php echo esc_attr( $v1_pad_top ) . 'px'; ?>;
            --cc-hero-v1-padding-bottom: <?php echo esc_attr( $v1_pad_bottom ) . 'px'; ?>;
            --cc-hero-v1-title-size: <?php echo esc_attr( $v1_title_size ) . 'px'; ?>;
            --cc-hero-v1-title-margin-bottom: <?php echo esc_attr( $v1_title_marg ) . 'px'; ?>;
            --cc-hero-v1-desc-size: <?php echo esc_attr( $v1_desc_size ) . 'px'; ?>;
            --cc-hero-v1-desc-margin-bottom: <?php echo esc_attr( $v1_desc_marg ) . 'px'; ?>;

            --cc-hero-v1-btn1-bg: <?php echo esc_attr( $v1_btn1_bg ); ?>;
            --cc-hero-v1-btn1-text: <?php echo esc_attr( $v1_btn1_txt ); ?>;
            --cc-hero-v1-btn2-bg: <?php echo esc_attr( $v1_btn2_bg ); ?>;
            --cc-hero-v1-btn2-text: <?php echo esc_attr( $v1_btn2_txt ); ?>;
            --cc-hero-v1-btn-radius: <?php echo esc_attr( $v1_btn_shape ); ?>;

            --cc-hero-v1-shape-main-color: <?php echo esc_attr( $v1_shape_main ); ?>;
            --cc-hero-v1-shape-yellow-color: <?php echo esc_attr( $v1_shape_yellow ); ?>;
            --cc-hero-v1-shape-blue-color: <?php echo esc_attr( $v1_shape_blue ); ?>;
            --cc-hero-v1-shape-red-color: <?php echo esc_attr( $v1_shape_red ); ?>;
            --cc-hero-v1-shape-purple-color: <?php echo esc_attr( $v1_shape_purple ); ?>;

            --cc-hero-v1-stat-num-color: <?php echo esc_attr( $v1_stat_num ); ?>;
            --cc-hero-v1-stat-label-color: <?php echo esc_attr( $v1_stat_label ); ?>;

            /* === VARIAN 2 (CENTERED) === */
            --cc-hero-v2-padding-top: <?php echo esc_attr( $v2_pad_top ) . 'px'; ?>;
            --cc-hero-v2-padding-bottom: <?php echo esc_attr( $v2_pad_bottom ) . 'px'; ?>;
            --cc-hero-v2-title-size: <?php echo esc_attr( $v2_title_size ) . 'px'; ?>;
            --cc-hero-v2-title-margin-bottom: <?php echo esc_attr( $v2_title_marg ) . 'px'; ?>;
            --cc-hero-v2-desc-size: <?php echo esc_attr( $v2_desc_size ) . 'px'; ?>;
            --cc-hero-v2-desc-margin-bottom: <?php echo esc_attr( $v2_desc_marg ) . 'px'; ?>;

            --cc-hero-v2-btn1-bg: <?php echo esc_attr( $v2_btn1_bg ); ?>;
            --cc-hero-v2-btn1-text: <?php echo esc_attr( $v2_btn1_txt ); ?>;
            --cc-hero-v2-btn2-bg: <?php echo esc_attr( $v2_btn2_bg ); ?>;
            --cc-hero-v2-btn2-text: <?php echo esc_attr( $v2_btn2_txt ); ?>;
            --cc-hero-v2-btn-radius: <?php echo esc_attr( $v2_btn_shape ); ?>;

            --cc-hero-v2-glow-color-1: <?php echo esc_attr( $v2_glow_1 ); ?>;
            --cc-hero-v2-glow-color-2: <?php echo esc_attr( $v2_glow_2 ); ?>;
            --cc-hero-v2-shape-red-color: <?php echo esc_attr( $v2_shape_red ); ?>;
            --cc-hero-v2-shape-purple-color: <?php echo esc_attr( $v2_shape_purple ); ?>;
            --cc-hero-v2-shape-yellow-color: <?php echo esc_attr( $v2_shape_yellow ); ?>;
            --cc-hero-v2-shape-blue-color: <?php echo esc_attr( $v2_shape_blue ); ?>;

            --cc-hero-v2-stat-num-color: <?php echo esc_attr( $v2_stat_num ); ?>;
            --cc-hero-v2-stat-label-color: <?php echo esc_attr( $v2_stat_label ); ?>;

            /* === VARIAN 3 (JASPER) === */
            --cc-hero-v3-padding-top: <?php echo esc_attr( $v3_pad_top ) . 'px'; ?>;
            --cc-hero-v3-padding-bottom: <?php echo esc_attr( $v3_pad_bottom ) . 'px'; ?>;
            --cc-hero-v3-title-size: <?php echo esc_attr( $v3_title_size ) . 'px'; ?>;
            --cc-hero-v3-title-margin-bottom: <?php echo esc_attr( $v3_title_marg ) . 'px'; ?>;
            --cc-hero-v3-desc-size: <?php echo esc_attr( $v3_desc_size ) . 'px'; ?>;
            --cc-hero-v3-desc-margin-bottom: <?php echo esc_attr( $v3_desc_marg ) . 'px'; ?>;

            --cc-hero-v3-card-radius: <?php echo esc_attr( $v3_card_radius ) . 'px'; ?>;
            --cc-hero-v3-canvas-radius: <?php echo esc_attr( $v3_canvas_radius ) . 'px'; ?>;

            --cc-hero-v3-btn1-bg: <?php echo esc_attr( $v3_btn1_bg ); ?>;
            --cc-hero-v3-btn1-text: <?php echo esc_attr( $v3_btn1_txt ); ?>;
            --cc-hero-v3-btn2-bg: <?php echo esc_attr( $v3_btn2_bg ); ?>;
            --cc-hero-v3-btn2-text: <?php echo esc_attr( $v3_btn2_txt ); ?>;
            --cc-hero-v3-btn-radius: <?php echo esc_attr( $v3_btn_shape ); ?>;

            --cc-hero-v3-canvas-bg: <?php echo esc_attr( $v3_canvas_bg ); ?>;
            --cc-hero-v3-triangle-color: <?php echo esc_attr( $v3_triangle ); ?>;
            --cc-hero-v3-card-right-bg: <?php echo esc_attr( $v3_card_right_bg ); ?>;
            --cc-hero-v3-circle-color: <?php echo esc_attr( $v3_circle ); ?>;
            --cc-hero-v3-blue-bars-color: <?php echo esc_attr( $v3_blue_bars ); ?>;

            /* === GLOBAL === */
            --cc-hero-title-weight: <?php echo esc_attr( $title_weight ); ?>;
        }
    </style>
    <?php
}
