<?php
/**
 * Template Part: CTA (Hubungi Marketing) Section.
 * Data diambil dari Customizer (cc_cta_*).
 *
 * @package CredibleCompany
 */

$cta_title  = cc_get( 'cta_title', 'Hubungi Marketing Kami' );
$cta_desc   = cc_get( 'cta_desc', 'Untuk mendapatkan Harga Promo dan Diskon menarik 50%' );
$cta_btn    = cc_get( 'cta_button_text', 'Hubungi Admin' );
$cta_url    = cc_get( 'cta_button_url', 'https://wa.me/6281234567890' );
$cta_layout = cc_get( 'cta_layout', 'centered' );
?>

<section class="cta cta-layout-<?php echo esc_attr( $cta_layout ); ?>">
    <div class="container">
        <?php if ( 'split' === $cta_layout || 'red-banner' === $cta_layout ) : ?>
            <div class="cta-split-wrapper">
                <div class="cta-content">
                    <h2><?php echo esc_html( cc_dynamic_text( $cta_title ) ); ?></h2>
                    <p><?php echo esc_html( $cta_desc ); ?></p>
                </div>
                <div class="cta-action">
                    <a href="<?php echo esc_url( cc_dynamic_wa_url( $cta_url ) ); ?>" class="btn btn-primary" target="_blank" rel="noopener">
                        <?php echo esc_html( cc_dynamic_text( $cta_btn ) ); ?>
                    </a>
                </div>
            </div>
        <?php else : ?>
            <h2><?php echo esc_html( cc_dynamic_text( $cta_title ) ); ?></h2>
            <p><?php echo esc_html( $cta_desc ); ?></p>
            <a href="<?php echo esc_url( cc_dynamic_wa_url( $cta_url ) ); ?>" class="btn btn-primary" target="_blank" rel="noopener">
                <?php echo esc_html( cc_dynamic_text( $cta_btn ) ); ?>
            </a>
        <?php endif; ?>
    </div>
</section>

