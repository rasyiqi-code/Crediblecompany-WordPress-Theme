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
?>

<section class="cta">
    <div class="container">
        <h2><?php echo esc_html( cc_dynamic_text( $cta_title ) ); ?></h2>
        <p><?php echo esc_html( $cta_desc ); ?></p>
        <a href="<?php echo esc_url( cc_dynamic_wa_url( $cta_url ) ); ?>" class="btn btn-primary" target="_blank" rel="noopener">
            <?php echo esc_html( cc_dynamic_text( $cta_btn ) ); ?>
        </a>
    </div>
</section>
