<?php
/**
 * Template Part: Mitra & Partners Section.
 * Dua bagian:
 *   1. Mitra Resmi (lembaga/sertifikasi) + tagline proses
 *   2. Mitra Pembayaran & Pengiriman
 *
 * @package CredibleCompany
 */

// Mitra Resmi / Sertifikasi (dari 6 slot Customizer)
$mitra_logos = array();
for ( $i = 1; $i <= 6; $i++ ) {
    $logo_url = cc_get( "mitra_logo_{$i}", '' );
    if ( ! empty( $logo_url ) ) {
        $mitra_logos[] = $logo_url;
    }
}

// Fallback teks jika belum ada 1 pun logo diupload
$mitra_resmi_fallback = array( 'Mitra 1', 'Mitra 2', 'Mitra 3', 'Mitra 4' );

// Tagline proses kerja (dari Customizer)
$proses_tagline = cc_get(
    'mitra_proses_tagline',
    'Lorem Ipsum → Dolor Sit → Consectetur → Adipiscing → Proin Sodales'
);

// Mitra Pembayaran & Pengiriman (dari 8 slot logo Customizer)
$payment_logos = array();
for ( $i = 1; $i <= 8; $i++ ) {
    $logo_url = cc_get( "mitra_payment_logo_{$i}", '' );
    if ( ! empty( $logo_url ) ) {
        $payment_logos[] = $logo_url;
    }
}

// Mitra Pembayaran & Pengiriman (dari Customizer, pisahkan koma - sebagai fallback teks)
$mitra_bayar_raw = cc_get( 'mitra_payment', 'Lorem, Ipsum, Dolor, Sit, Amet, Consectetur' );
$mitra_bayar     = array_filter( array_map( 'trim', explode( ',', $mitra_bayar_raw ) ) );
?>

<!-- ===== Mitra Resmi / Sertifikasi ===== -->
<section class="mitra-resmi section-divider-top" id="mitra">
    <div class="container text-center">
        <!-- Logo mitra resmi (infinite marquee style) -->
        <div class="mitra-resmi-logos">
            <div class="marquee-wrapper">
                <?php for ( $dup = 0; $dup < 2; $dup++ ) : ?>
                    <div class="marquee-content" <?php echo $dup === 1 ? 'aria-hidden="true"' : ''; ?>>
                        <?php
                        if ( ! empty( $mitra_logos ) ) :
                            // Tampilkan gambar logo
                            foreach ( $mitra_logos as $index => $logo ) : ?>
                                <div class="mitra-resmi-item mitra-item-img">
                                    <img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( "Mitra Resmi CredibleCompany - Logo " . ($index + 1) ); ?>">
                                </div>
                            <?php endforeach;
                        else :
                            // Fallback teks
                            foreach ( $mitra_resmi_fallback as $text ) : ?>
                                <span class="mitra-resmi-item"><?php echo esc_html( $text ); ?></span>
                            <?php endforeach;
                        endif;
                        ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <!-- Tagline Proses Kerja -->
        <p class="mitra-proses-tagline"><?php echo esc_html( $proses_tagline ); ?></p>
    </div>
</section>

<!-- ===== Mitra Pembayaran & Pengiriman ===== -->
<section class="partners">
    <div class="container">
        <p class="partners-label"><?php echo esc_html( cc_get( 'mitra_payment_label', 'Pembayaran dan Pengiriman Didukung oleh Mitra Tepercaya Kami' ) ); ?></p>
        <?php $scroll_class = cc_get( 'mobile_scroll_partners', true ) ? 'has-horizontal-scroll' : ''; ?>
        <div class="partners-logos <?php echo esc_attr( $scroll_class ); ?>">
            <?php if ( ! empty( $payment_logos ) ) : ?>
                <?php foreach ( $payment_logos as $index => $logo ) : ?>
                    <img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( "Mitra Pembayaran/Pengiriman - Logo " . ($index + 1) ); ?>" class="partner-logo-img">
                <?php endforeach; ?>
            <?php else : ?>
                <?php foreach ( $mitra_bayar as $partner ) : ?>
                    <span><?php echo esc_html( $partner ); ?></span>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

