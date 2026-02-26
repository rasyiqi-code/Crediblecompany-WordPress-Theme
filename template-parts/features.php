<?php
/**
 * Template Part: Features Section (Mengapa Memilih Kami).
 * 6 fitur dari Customizer (cc_feat_*).
 *
 * @package CredibleCompany
 */

// Ikon SVG untuk setiap fitur
$icons = array(
    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
    '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>',
);
?>

<section class="features section-divider-top section-divider-bottom">
    <div class="container">
        <h2><?php cc_e( 'features_title', 'Mengapa Memilih Kami?' ); ?></h2>

        <?php $scroll_class = cc_get( 'mobile_scroll_features', true ) ? 'has-horizontal-scroll' : ''; ?>
        <div class="features-grid <?php echo esc_attr( $scroll_class ); ?>">
            <?php for ( $i = 1; $i <= 6; $i++ ) :
                $title = cc_get( "feat_title_{$i}", '' );
                $desc  = cc_get( "feat_desc_{$i}", '' );
                $icon  = isset( $icons[ $i - 1 ] ) ? $icons[ $i - 1 ] : '';
            ?>
                <div class="feature-item">
                    <div class="feature-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"><?php echo $icon; ?></svg>
                    </div>
                    <h3><?php echo esc_html( $title ); ?></h3>
                    <p><?php echo esc_html( $desc ); ?></p>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>
