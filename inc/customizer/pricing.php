<?php
/**
 * Customizer: Pricing Section (Paket Jasa)
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_pricing_section', array(
        'title'    => __( 'Section Paket Jasa', 'crediblecompany' ),
        'panel'    => 'cc_homepage_panel',
        'priority' => 40,
    ) );

    $wp_customize->add_setting( 'cc_pricing_title', array(
        'default'           => 'Lorem Ipsum Dolor',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_pricing_title', array(
        'label'   => __( 'Judul Section', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'cc_pricing_subtitle', array(
        'default'           => 'Anda bisa memilih kami untuk jasa berikut:',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_pricing_subtitle', array(
        'label'   => __( 'Subtitle Section', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'cc_pricing_grid_columns', array(
        'default'           => 4,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'cc_pricing_grid_columns', array(
        'label'   => __( 'Jumlah Kolom Desktop', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
        'type'    => 'select',
        'choices' => array(
            2 => '2 Kolom',
            3 => '3 Kolom',
            4 => '4 Kolom',
            5 => '5 Kolom',
            6 => '6 Kolom',
        ),
    ) );

    // Jarak antara judul/deskripsi section dengan card (margin-bottom)
    $wp_customize->add_setting( 'cc_pricing_header_margin_bottom', array(
        'default'           => 48,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'cc_pricing_header_margin_bottom', array(
        'label'       => __( 'Jarak Antara Judul & Card (px)', 'crediblecompany' ),
        'description' => __( 'Mengatur jarak (margin-bottom) antara judul/deskripsi dengan kartu paket jasa.', 'crediblecompany' ),
        'section'     => 'cc_pricing_section',
        'type'        => 'range',
        'input_attrs' => array(
            'min'  => 8,
            'max'  => 120,
            'step' => 4,
        ),
    ) );

    // Pengaturan Warna Section Pricing
    $wp_customize->add_setting( 'cc_pricing_bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_pricing_bg_color', array(
        'label'   => __( 'Warna Latar Belakang Section', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
    ) ) );

    $wp_customize->add_setting( 'cc_pricing_text_color', array(
        'default'           => '#0f172a',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_pricing_text_color', array(
        'label'   => __( 'Warna Font Judul/Sub', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
    ) ) );

    $wp_customize->add_setting( 'cc_pricing_card_bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_pricing_card_bg_color', array(
        'label'   => __( 'Warna Latar Belakang Card', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
    ) ) );

    // Warna Background Header Card
    $wp_customize->add_setting( 'cc_pricing_card_header_bg', array(
        'default'           => '#c01314',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_pricing_card_header_bg', array(
        'label'   => __( 'Warna Latar Header Card', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
    ) ) );

    // Warna Teks Header Card
    $wp_customize->add_setting( 'cc_pricing_card_header_text', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_pricing_card_header_text', array(
        'label'   => __( 'Warna Teks Header Card', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
    ) ) );

    // Warna Background Body Card
    $wp_customize->add_setting( 'cc_pricing_card_body_bg', array(
        'default'           => '#f1f5f9',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_pricing_card_body_bg', array(
        'label'   => __( 'Warna Latar Body Card', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
    ) ) );

    // Warna Teks Harga Paket
    $wp_customize->add_setting( 'cc_pricing_card_price_color', array(
        'default'           => '#c01314',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_pricing_card_price_color', array(
        'label'   => __( 'Warna Teks Harga', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
    ) ) );

    // Warna Teks Spesifikasi (Eksemplar & Ukuran)
    $wp_customize->add_setting( 'cc_pricing_card_spec_color', array(
        'default'           => '#0f172a',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_pricing_card_spec_color', array(
        'label'   => __( 'Warna Teks Spesifikasi', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
    ) ) );

    // Warna Teks Judul Fasilitas
    $wp_customize->add_setting( 'cc_pricing_card_feat_title_color', array(
        'default'           => '#c01314',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_pricing_card_feat_title_color', array(
        'label'   => __( 'Warna Judul Fasilitas', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
    ) ) );

    // Warna Latar Badge
    $wp_customize->add_setting( 'cc_pricing_card_badge_bg', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_pricing_card_badge_bg', array(
        'label'   => __( 'Warna Latar Badge', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
    ) ) );

    // Warna Teks Badge
    $wp_customize->add_setting( 'cc_pricing_card_badge_text', array(
        'default'           => '#c01314',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_pricing_card_badge_text', array(
        'label'   => __( 'Warna Teks Badge', 'crediblecompany' ),
        'section' => 'cc_pricing_section',
    ) ) );

} );

/**
 * Suntikkan Variabel CSS Dinamis untuk Pricing Section ke Header.
 */
add_action( 'wp_head', function() {
    $margin_bottom = cc_get( 'pricing_header_margin_bottom', 48 );
    $bg_color      = cc_get( 'pricing_bg_color', '#ffffff' );
    $text_color    = cc_get( 'pricing_text_color', '#0f172a' );
    $card_bg       = cc_get( 'pricing_card_bg_color', '#ffffff' );

    $card_hdr_bg   = cc_get( 'pricing_card_header_bg', '#c01314' );
    $card_hdr_txt  = cc_get( 'pricing_card_header_text', '#ffffff' );
    $card_body_bg  = cc_get( 'pricing_card_body_bg', '#f1f5f9' );
    $card_price    = cc_get( 'pricing_card_price_color', '#c01314' );
    $card_spec     = cc_get( 'pricing_card_spec_color', '#0f172a' );
    $card_feat     = cc_get( 'pricing_card_feat_title_color', '#c01314' );
    $card_bdg_bg   = cc_get( 'pricing_card_badge_bg', '#ffffff' );
    $card_bdg_txt  = cc_get( 'pricing_card_badge_text', '#c01314' );
    ?>
    <style type="text/css" id="cc-pricing-dynamic-css">
        :root {
            --cc-pricing-header-margin-bottom: <?php echo esc_attr( $margin_bottom ) . 'px'; ?>;
            --cc-pricing-bg-color: <?php echo esc_attr( $bg_color ); ?>;
            --cc-pricing-text-color: <?php echo esc_attr( $text_color ); ?>;
            --cc-pricing-card-bg-color: <?php echo esc_attr( $card_bg ); ?>;

            --cc-pricing-card-header-bg: <?php echo esc_attr( $card_hdr_bg ); ?>;
            --cc-pricing-card-header-text: <?php echo esc_attr( $card_hdr_txt ); ?>;
            --cc-pricing-card-body-bg: <?php echo esc_attr( $card_body_bg ); ?>;
            --cc-pricing-card-price-color: <?php echo esc_attr( $card_price ); ?>;
            --cc-pricing-card-spec-color: <?php echo esc_attr( $card_spec ); ?>;
            --cc-pricing-card-feat-title-color: <?php echo esc_attr( $card_feat ); ?>;
            --cc-pricing-card-badge-bg: <?php echo esc_attr( $card_bdg_bg ); ?>;
            --cc-pricing-card-badge-text: <?php echo esc_attr( $card_bdg_txt ); ?>;
        }
    </style>
    <?php
}, 100 );


