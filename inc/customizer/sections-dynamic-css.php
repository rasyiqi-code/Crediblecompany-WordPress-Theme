<?php
/**
 * Customizer: Sections Dynamic CSS - Menyuntikkan Variabel CSS Dinamis ke Header
 *
 * @package CredibleCompany
 */

// Mencegah akses langsung
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'wp_head', 'cc_sections_dynamic_css_variables', 100 );
function cc_sections_dynamic_css_variables() {
    // 1. Statistics
    $stat_bg    = cc_get( 'stat_bg_color', '#ffffff' );
    $stat_num   = cc_get( 'stat_number_color', '#F59E0B' );
    $stat_label = cc_get( 'stat_label_color', '#1e293b' );
    $stat_gap   = cc_get( 'stat_gap', 32 );
    $stat_pad   = cc_get( 'stat_padding', 64 );
    $stat_count = cc_get( 'stats_count', 3 );

    // About
    $about_bg             = cc_get( 'about_bg_color', '#ffffff' );
    $about_block_bg       = cc_get( 'about_block_bg_color', '#f1f5f9' );
    $about_txt            = cc_get( 'about_text_color', '#334155' );
    $about_pad_lr_desktop = cc_get( 'about_text_padding_lr_desktop', 0 );
    $about_pad_lr_mobile  = cc_get( 'about_text_padding_lr_mobile', 16 );
    $about_padding_desktop = cc_get( 'about_padding_desktop', 64 );
    $about_padding_mobile  = cc_get( 'about_padding_mobile', 40 );

    // 2. Features
    $feat_bg       = cc_get( 'features_bg_color', '#f8fafc' );
    $feat_tit      = cc_get( 'features_title_color', '#0f172a' );
    $feat_desc     = cc_get( 'features_desc_color', '#475569' );
    $feat_count    = cc_get( 'features_count', 3 );
    $feat_item_bg  = cc_get( 'features_item_bg_color', 'transparent' );
    $feat_item_pad = ( $feat_item_bg !== 'transparent' && ! empty( $feat_item_bg ) ) ? '24px' : '0px';
    $feat_icon_bg  = cc_get( 'features_icon_bg_color', '#dc2626' );
    $feat_icon_col = cc_get( 'features_icon_color', '#ffffff' );
    $feat_pad_dt   = cc_get( 'features_padding_desktop', 64 );
    $feat_pad_mob  = cc_get( 'features_padding_mobile', 40 );
    $feat_gap_dt   = cc_get( 'features_gap_desktop', 32 );
    $feat_gap_mob  = cc_get( 'features_gap_mobile', 20 );

    // 3. Testimonials
    $test_bg   = cc_get( 'testimonials_bg_color', '#f8fafc' );
    $test_card = cc_get( 'testimonials_card_bg_color', '#ffffff' );
    $test_txt  = cc_get( 'testimonials_text_color', '#0f172a' );

    // 4. Mitra & Partners
    $mitra_bg        = cc_get( 'mitra_bg_color', '#ffffff' );
    $partners_bg     = cc_get( 'mitra_partners_bg_color', '#ffffff' );
    $mitra_grayscale = cc_get( 'mitra_payment_grayscale', true ) ? 'grayscale(100%)' : 'none';
    $mitra_speed     = cc_get( 'mitra_marquee_speed', 20 );
    $proses_tag_col  = cc_get( 'mitra_proses_tagline_color', '#c01314' );
    $partners_tag_col = cc_get( 'mitra_payment_label_color', '#64748b' );
    $mitra_pad_dt    = cc_get( 'mitra_resmi_padding_desktop', 48 );
    $mitra_pad_mob   = cc_get( 'mitra_resmi_padding_mobile', 32 );
    $partners_pad_dt = cc_get( 'mitra_partners_padding_desktop', 32 );
    $partners_pad_mob = cc_get( 'mitra_partners_padding_mobile', 24 );

    // 5. Books
    $books_bg      = cc_get( 'books_bg_color', '#ffffff' );
    $books_tit     = cc_get( 'books_title_color', '#0f172a' );
    $books_btn_bg  = cc_get( 'books_btn_bg_color', 'transparent' );
    $books_btn_txt = cc_get( 'books_btn_text_color', '#0f172a' );
    $books_btn_hbg = cc_get( 'books_btn_hover_bg_color', '#0f172a' );
    $books_btn_htxt = cc_get( 'books_btn_hover_text_color', '#ffffff' );
    $books_pad_dt  = cc_get( 'books_padding_desktop', 64 );
    $books_pad_mob = cc_get( 'books_padding_mobile', 40 );
    $books_gap_dt  = cc_get( 'books_gap_desktop', 24 );
    $books_gap_mob = cc_get( 'books_gap_mobile', 12 );

    // 6. Blog Homepage
    $blog_bg  = cc_get( 'blog_section_bg_color', '#f8fafc' );
    $blog_tit = cc_get( 'blog_section_title_color', '#0f172a' );

    // 7. FAQ
    $faq_bg      = cc_get( 'faq_bg_color', '#c01314' );
    $faq_tit_col = cc_get( 'faq_title_color', '#ffffff' );
    $faq_ques    = cc_get( 'faq_question_color', '#ffffff' );
    $faq_answ    = cc_get( 'faq_answer_color', '#f3f4f6' );

    // 8. CTA
    $cta_custom_bg   = cc_get( 'cta_custom_bg_color', '' );
    $cta_custom_text = cc_get( 'cta_custom_text_color', '' );
    $cta_btn_bg      = cc_get( 'cta_btn_bg', '' );
    $cta_btn_text    = cc_get( 'cta_btn_text', '' );
    $cta_btn_hbg     = cc_get( 'cta_btn_hover_bg', '' );
    $cta_btn_htxt    = cc_get( 'cta_btn_hover_text', '' );

    // 9. Footer
    $foot_bg  = cc_get( 'footer_bg_color', '#0b1c3f' );
    $foot_txt = cc_get( 'footer_text_color', '#ffffff' );
    $foot_logo_bg = cc_get( 'footer_logo_bg', '#ffffff' );
    $foot_middle_bg = cc_get( 'footer_middle_bg', '#ffffff' );
    $foot_middle_txt = cc_get( 'footer_middle_text_color', '#000000' );
    $foot_stats_bg = cc_get( 'footer_stats_bg', '#ffffff' );
    $foot_stats_txt = cc_get( 'footer_stats_text_color', '#000000' );

    $foot_social_bg = cc_get( 'footer_social_bg', '#ffffff' );
    $foot_social_icon = cc_get( 'footer_social_icon_color', '#000000' );
    $foot_social_hover_bg = cc_get( 'footer_social_hover_bg', '#d4af37' );
    $foot_social_hover_icon = cc_get( 'footer_social_hover_icon_color', '#000000' );

    $foot_top_pad = cc_get( 'footer_top_padding', 40 );
    $foot_middle_pad = cc_get( 'footer_middle_padding', 24 );
    $foot_bottom_pad = cc_get( 'footer_bottom_padding', 24 );

    // 10. Header
    $header_style        = cc_get( 'header_style', 'classic' );

    // Memuat nilai berdasarkan gaya header yang dipilih
    if ( 'classic' === $header_style ) {
        $header_bg           = cc_get( 'header_classic_bg_color', '#c01314' );
        $header_text         = cc_get( 'header_classic_text_color', '#ffffff' );
        $text_hover          = cc_get( 'header_classic_text_hover_color', '#ffcccc' );
        $header_padding      = cc_get( 'header_classic_padding', 12 );
        $menu_font_size      = cc_get( 'header_classic_menu_font_size', 14 );
        $border_enable       = cc_get( 'header_classic_border_enable', false );
        $border_color        = cc_get( 'header_classic_border_color', 'rgba(255, 255, 255, 0.15)' );
        $mobile_bg           = cc_get( 'header_classic_mobile_bg_color', '' );
        $mobile_text         = cc_get( 'header_classic_mobile_text_color', '' );
        $mobile_hover        = cc_get( 'header_classic_mobile_text_hover_color', '' );

        $glass_opacity       = 85 / 100;
        $glass_blur          = 12;
    } elseif ( 'centered' === $header_style ) {
        $header_bg           = cc_get( 'header_centered_bg_color', '#c01314' );
        $header_text         = cc_get( 'header_centered_text_color', '#ffffff' );
        $text_hover          = cc_get( 'header_centered_text_hover_color', '#ffcccc' );
        $header_padding      = cc_get( 'header_centered_padding', 12 );
        $menu_font_size      = cc_get( 'header_centered_menu_font_size', 14 );
        $border_enable       = cc_get( 'header_centered_border_enable', false );
        $border_color        = cc_get( 'header_centered_border_color', 'rgba(255, 255, 255, 0.15)' );
        $mobile_bg           = cc_get( 'header_centered_mobile_bg_color', '' );
        $mobile_text         = cc_get( 'header_centered_mobile_text_color', '' );
        $mobile_hover        = cc_get( 'header_centered_mobile_text_hover_color', '' );

        $glass_opacity       = 85 / 100;
        $glass_blur          = 12;
    } else { // glass
        $header_bg           = cc_get( 'header_glass_bg_color', '#ffffff' );
        $header_text         = cc_get( 'header_glass_text_color', '#ffffff' );
        $text_hover          = cc_get( 'header_glass_text_hover_color', '#ffcccc' );
        $header_padding      = 12; // Nilai default statis untuk glass
        $menu_font_size      = 14; // Nilai default statis untuk glass
        $border_enable       = cc_get( 'header_glass_border_enable', true );
        $border_color        = cc_get( 'header_glass_border_color', 'rgba(255, 255, 255, 0.08)' );
        $mobile_bg           = cc_get( 'header_glass_mobile_bg_color', '' );
        $mobile_text         = cc_get( 'header_glass_mobile_text_color', '' );
        $mobile_hover        = cc_get( 'header_glass_mobile_text_hover_color', '' );

        $glass_opacity       = cc_get( 'header_glass_opacity', 85 ) / 100;
        $glass_blur          = cc_get( 'header_glass_blur', 12 );
    }

    $header_sticky       = cc_get( 'header_sticky', true );
    $logo_width          = cc_get( 'header_logo_width', 150 );

    // Hitung RGBA latar belakang Glassmorphism
    $glass_bg_color = cc_hex_to_rgba( $header_bg, $glass_opacity );
    $mobile_glass_bg_color = ! empty( $mobile_bg ) ? cc_hex_to_rgba( $mobile_bg, $glass_opacity ) : $glass_bg_color;

    // Hitung border style
    $border_style = $border_enable ? '1px solid ' . $border_color : 'none';
    ?>
    <style type="text/css" id="cc-sections-dynamic-variables">
        :root {
            /* === STATISTICS === */
            --cc-stat-bg-color: <?php echo esc_attr( $stat_bg ); ?>;
            --cc-stat-number-color: <?php echo esc_attr( $stat_num ); ?>;
            --cc-stat-label-color: <?php echo esc_attr( $stat_label ); ?>;
            --cc-stat-gap: <?php echo esc_attr( $stat_gap ) . 'px'; ?>;
            --cc-stat-padding: <?php echo esc_attr( $stat_pad ) . 'px'; ?>;
            --cc-stats-count: <?php echo esc_attr( $stat_count ); ?>;

            /* === ABOUT === */
            --cc-about-bg-color: <?php echo esc_attr( $about_bg ); ?>;
            --cc-about-block-bg-color: <?php echo esc_attr( $about_block_bg ); ?>;
            --cc-about-text-color: <?php echo esc_attr( $about_txt ); ?>;
            --cc-about-text-padding-lr-desktop: <?php echo esc_attr( $about_pad_lr_desktop ) . 'px'; ?>;
            --cc-about-text-padding-lr-mobile: <?php echo esc_attr( $about_pad_lr_mobile ) . 'px'; ?>;
            --cc-about-padding-desktop: <?php echo esc_attr( $about_padding_desktop ) . 'px'; ?>;
            --cc-about-padding-mobile: <?php echo esc_attr( $about_padding_mobile ) . 'px'; ?>;

            /* === FEATURES === */
            --cc-features-bg-color: <?php echo esc_attr( $feat_bg ); ?>;
            --cc-features-title-color: <?php echo esc_attr( $feat_tit ); ?>;
            --cc-features-desc-color: <?php echo esc_attr( $feat_desc ); ?>;
            --cc-features-count: <?php echo esc_attr( $feat_count ); ?>;
            --cc-features-item-bg-color: <?php echo esc_attr( $feat_item_bg ); ?>;
            --cc-features-item-padding: <?php echo esc_attr( $feat_item_pad ); ?>;
            --cc-features-icon-bg-color: <?php echo esc_attr( $feat_icon_bg ); ?>;
            --cc-features-icon-color: <?php echo esc_attr( $feat_icon_col ); ?>;
            --cc-features-padding-desktop: <?php echo esc_attr( $feat_pad_dt ) . 'px'; ?>;
            --cc-features-padding-mobile: <?php echo esc_attr( $feat_pad_mob ) . 'px'; ?>;
            --cc-features-gap-desktop: <?php echo esc_attr( $feat_gap_dt ) . 'px'; ?>;
            --cc-features-gap-mobile: <?php echo esc_attr( $feat_gap_mob ) . 'px'; ?>;

            /* === TESTIMONIALS === */
            --cc-testimonials-bg-color: <?php echo esc_attr( $test_bg ); ?>;
            --cc-testimonials-card-bg-color: <?php echo esc_attr( $test_card ); ?>;
            --cc-testimonials-text-color: <?php echo esc_attr( $test_txt ); ?>;

            /* === MITRA & PARTNERS === */
            --cc-mitra-bg-color: <?php echo esc_attr( $mitra_bg ); ?>;
            --cc-mitra-partners-bg-color: <?php echo esc_attr( $partners_bg ); ?>;
            --cc-mitra-payment-grayscale: <?php echo esc_attr( $mitra_grayscale ); ?>;
            --cc-mitra-marquee-speed: <?php echo esc_attr( $mitra_speed ) . 's'; ?>;
            --cc-mitra-proses-tagline-color: <?php echo esc_attr( $proses_tag_col ); ?>;
            --cc-mitra-payment-label-color: <?php echo esc_attr( $partners_tag_col ); ?>;
            --cc-mitra-resmi-padding-desktop: <?php echo esc_attr( $mitra_pad_dt ) . 'px'; ?>;
            --cc-mitra-resmi-padding-mobile: <?php echo esc_attr( $mitra_pad_mob ) . 'px'; ?>;
            --cc-mitra-partners-padding-desktop: <?php echo esc_attr( $partners_pad_dt ) . 'px'; ?>;
            --cc-mitra-partners-padding-mobile: <?php echo esc_attr( $partners_pad_mob ) . 'px'; ?>;

            /* === BOOKS === */
            --cc-books-bg-color: <?php echo esc_attr( $books_bg ); ?>;
            --cc-books-title-color: <?php echo esc_attr( $books_tit ); ?>;
            --cc-books-btn-bg-color: <?php echo esc_attr( $books_btn_bg ); ?>;
            --cc-books-btn-text-color: <?php echo esc_attr( $books_btn_txt ); ?>;
            --cc-books-btn-hover-bg-color: <?php echo esc_attr( $books_btn_hbg ); ?>;
            --cc-books-btn-hover-text-color: <?php echo esc_attr( $books_btn_htxt ); ?>;
            --cc-books-padding-desktop: <?php echo esc_attr( $books_pad_dt ) . 'px'; ?>;
            --cc-books-padding-mobile: <?php echo esc_attr( $books_pad_mob ) . 'px'; ?>;
            --cc-books-gap-desktop: <?php echo esc_attr( $books_gap_dt ) . 'px'; ?>;
            --cc-books-gap-mobile: <?php echo esc_attr( $books_gap_mob ) . 'px'; ?>;

            /* === BLOG HOMEPAGE === */
            --cc-blog-section-bg-color: <?php echo esc_attr( $blog_bg ); ?>;
            --cc-blog-section-title-color: <?php echo esc_attr( $blog_tit ); ?>;

            /* === FAQ === */
            --cc-faq-bg-color: <?php echo esc_attr( $faq_bg ); ?>;
            --cc-faq-title-color: <?php echo esc_attr( $faq_tit_col ); ?>;
            --cc-faq-question-color: <?php echo esc_attr( $faq_ques ); ?>;
            --cc-faq-answer-color: <?php echo esc_attr( $faq_answ ); ?>;

            /* === CTA === */
            <?php if ( ! empty( $cta_custom_bg ) ) : ?>
            --cc-cta-custom-bg-color: <?php echo esc_attr( $cta_custom_bg ); ?>;
            <?php endif; ?>
            <?php if ( ! empty( $cta_custom_text ) ) : ?>
            --cc-cta-custom-text-color: <?php echo esc_attr( $cta_custom_text ); ?>;
            <?php endif; ?>
            <?php if ( ! empty( $cta_btn_bg ) ) : ?>
            --cc-cta-btn-bg: <?php echo esc_attr( $cta_btn_bg ); ?>;
            <?php endif; ?>
            <?php if ( ! empty( $cta_btn_text ) ) : ?>
            --cc-cta-btn-text: <?php echo esc_attr( $cta_btn_text ); ?>;
            <?php endif; ?>
            <?php if ( ! empty( $cta_btn_hbg ) ) : ?>
            --cc-cta-btn-hover-bg: <?php echo esc_attr( $cta_btn_hbg ); ?>;
            <?php endif; ?>
            <?php if ( ! empty( $cta_btn_htxt ) ) : ?>
            --cc-cta-btn-hover-text: <?php echo esc_attr( $cta_btn_htxt ); ?>;
            <?php endif; ?>

            /* === FOOTER === */
            --cc-footer-bg-color: <?php echo esc_attr( $foot_bg ); ?>;
            --cc-footer-text-color: <?php echo esc_attr( $foot_txt ); ?>;
            --cc-footer-logo-bg: <?php echo esc_attr( $foot_logo_bg ); ?>;
            --cc-footer-middle-bg: <?php echo esc_attr( $foot_middle_bg ); ?>;
            --cc-footer-middle-text-color: <?php echo esc_attr( $foot_middle_txt ); ?>;
            --cc-footer-stats-bg: <?php echo esc_attr( $foot_stats_bg ); ?>;
            --cc-footer-stats-text-color: <?php echo esc_attr( $foot_stats_txt ); ?>;

            --cc-footer-social-bg: <?php echo esc_attr( $foot_social_bg ); ?>;
            --cc-footer-social-icon-color: <?php echo esc_attr( $foot_social_icon ); ?>;
            --cc-footer-social-hover-bg: <?php echo esc_attr( $foot_social_hover_bg ); ?>;
            --cc-footer-social-hover-icon-color: <?php echo esc_attr( $foot_social_hover_icon ); ?>;

            --cc-footer-top-padding: <?php echo esc_attr( $foot_top_pad ) . 'px'; ?>;
            --cc-footer-middle-padding: <?php echo esc_attr( $foot_middle_pad ) . 'px'; ?>;
            --cc-footer-bottom-padding: <?php echo esc_attr( $foot_bottom_pad ) . 'px'; ?>;

            /* === HEADER === */
            --cc-header-style: <?php echo esc_attr( $header_style ); ?>;
            --cc-header-bg: <?php echo esc_attr( $header_bg ); ?>;
            --cc-header-text: <?php echo esc_attr( $header_text ); ?>;
            --cc-header-text-hover: <?php echo esc_attr( $text_hover ); ?>;
            --cc-header-logo-width: <?php echo esc_attr( $logo_width ) . 'px'; ?>;
            --cc-header-padding: <?php echo esc_attr( $header_padding ) . 'px'; ?>;
            --cc-header-menu-font-size: <?php echo esc_attr( $menu_font_size ) . 'px'; ?>;
            --cc-header-glass-bg: <?php echo esc_attr( $glass_bg_color ); ?>;
            --cc-header-glass-blur: <?php echo esc_attr( $glass_blur ) . 'px'; ?>;
            --cc-header-border: <?php echo esc_attr( $border_style ); ?>;
            --cc-header-sticky: <?php echo $header_sticky ? 'sticky' : 'relative'; ?>;
            --cc-header-sticky-top: <?php echo $header_style === 'glass' ? '1.25rem' : '0'; ?>;
            --cc-header-sticky-top-admin: <?php echo $header_style === 'glass' ? 'calc(32px + 1.25rem)' : '32px'; ?>;
            --cc-header-sticky-top-mobile-admin: <?php echo $header_style === 'glass' ? 'calc(46px + 0.75rem)' : '46px'; ?>;
            --cc-header-sticky-top-mobile: <?php echo $header_style === 'glass' ? '0.75rem' : '0'; ?>;

            /* Mobile Overrides */
            --cc-header-mobile-bg: <?php echo esc_attr( ! empty( $mobile_bg ) ? $mobile_bg : $header_bg ); ?>;
            --cc-header-mobile-glass-bg: <?php echo esc_attr( $mobile_glass_bg_color ); ?>;
            --cc-header-mobile-text: <?php echo esc_attr( ! empty( $mobile_text ) ? $mobile_text : $header_text ); ?>;
            --cc-header-mobile-text-hover: <?php echo esc_attr( ! empty( $mobile_hover ) ? $mobile_hover : $text_hover ); ?>;
        }
    </style>
    <?php
}
