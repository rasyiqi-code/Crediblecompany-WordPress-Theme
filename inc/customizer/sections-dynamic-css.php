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
    $feat_bg    = cc_get( 'features_bg_color', '#f8fafc' );
    $feat_tit   = cc_get( 'features_title_color', '#0f172a' );
    $feat_desc  = cc_get( 'features_desc_color', '#475569' );
    $feat_count = cc_get( 'features_count', 3 );

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
    $books_bg  = cc_get( 'books_bg_color', '#ffffff' );
    $books_tit = cc_get( 'books_title_color', '#0f172a' );

    // 6. Blog Homepage
    $blog_bg  = cc_get( 'blog_section_bg_color', '#f8fafc' );
    $blog_tit = cc_get( 'blog_section_title_color', '#0f172a' );

    // 7. FAQ
    $faq_bg   = cc_get( 'faq_bg_color', '#c01314' );
    $faq_ques = cc_get( 'faq_question_color', '#ffffff' );
    $faq_answ = cc_get( 'faq_answer_color', '#f3f4f6' );

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

            /* === BLOG HOMEPAGE === */
            --cc-blog-section-bg-color: <?php echo esc_attr( $blog_bg ); ?>;
            --cc-blog-section-title-color: <?php echo esc_attr( $blog_tit ); ?>;

            /* === FAQ === */
            --cc-faq-bg-color: <?php echo esc_attr( $faq_bg ); ?>;
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
        }
    </style>
    <?php
}
