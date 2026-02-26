<?php
/**
 * Template Part: Pricing Section.
 * Menampilkan paket jasa dari CPT 'paket_jasa'.
 * Desain card disesuaikan dengan poster KBM (harga, eksemplar, ukuran, fasilitas).
 *
 * @package CredibleCompany
 */

$section_title    = cc_get( 'pricing_title', 'Jasa KBM Indonesia Group' );
$section_subtitle = cc_get( 'pricing_subtitle', 'Anda bisa memilih kami untuk jasa berikut:' );

$paket_query = new WP_Query( array(
    'post_type'      => 'paket_jasa',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
) );

$check_svg = '<svg class="check-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>';
?>

<section class="pricing">
    <div class="container text-center">
        <h2><?php echo esc_html( $section_title ); ?></h2>
        <p><?php echo esc_html( $section_subtitle ); ?></p>

        <?php
        $scroll_class = cc_get( 'mobile_scroll_pricing', true ) ? 'has-horizontal-scroll' : '';
        ?>


        <?php if ( $paket_query->have_posts() ) : // The condition remains $paket_query->have_posts() based on the original file structure. ?>
            <div class="pricing-grid <?php echo esc_attr( $scroll_class ); ?>">
                <?php while ( $paket_query->have_posts() ) : $paket_query->the_post();
                    $badge       = get_post_meta( get_the_ID(), '_cc_badge', true );
                    $price       = get_post_meta( get_the_ID(), '_cc_price', true );
                    $eksemplar   = get_post_meta( get_the_ID(), '_cc_eksemplar', true );
                    $ukuran      = get_post_meta( get_the_ID(), '_cc_ukuran', true );
                    $catatan     = get_post_meta( get_the_ID(), '_cc_catatan', true );
                    $btn_text    = get_post_meta( get_the_ID(), '_cc_btn_text', true ) ?: 'Ambil Promo';
                    $btn_url     = get_post_meta( get_the_ID(), '_cc_btn_url', true ) ?: '#';
                    $features_raw = get_post_meta( get_the_ID(), '_cc_features', true );
                    $features    = array_filter( array_map( 'trim', explode( "\n", $features_raw ) ) );
                ?>
                    <div class="price-card">
                        <!-- Header: Nama Paket -->
                        <div class="price-card-header">
                            <?php if ( $badge ) : ?>
                                <span class="price-card-badge"><?php echo esc_html( $badge ); ?></span>
                            <?php endif; ?>
                            <p class="price-card-label">Paket Penerbitan</p>
                            <h3 class="price-card-name"><?php the_title(); ?></h3>
                        </div>

                        <!-- Body: Harga, Eksemplar, Ukuran -->
                        <div class="price-card-body">
                            <p class="price-current"><?php echo esc_html( $price ); ?></p>
                            <?php if ( $eksemplar ) : ?>
                                <p class="price-eksemplar"><?php echo esc_html( $eksemplar ); ?></p>
                            <?php endif; ?>
                            <?php if ( $ukuran ) : ?>
                                <p class="price-ukuran"><?php echo esc_html( $ukuran ); ?></p>
                            <?php endif; ?>
                            <?php if ( $catatan ) : ?>
                                <p class="price-catatan"><?php echo esc_html( $catatan ); ?></p>
                            <?php endif; ?>
                        </div>

                        <!-- Fasilitas & Bonus -->
                        <?php if ( ! empty( $features ) ) : ?>
                            <div class="price-card-features-wrapper">
                                <h4 class="price-card-features-title">Fasilitas & Bonus</h4>
                                <ul class="price-card-features">
                                    <?php foreach ( $features as $feat ) : ?>
                                        <li><?php echo $check_svg; ?> <?php echo esc_html( $feat ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <!-- Tombol CTA -->
                        <div class="price-card-action">
                            <a href="<?php echo esc_url( $btn_url ); ?>" class="btn btn-primary btn-block" target="_blank" rel="noopener">
                                <?php echo esc_html( $btn_text ); ?>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <p style="color: var(--gray-500); margin-top: 2rem;">
                <?php esc_html_e( 'Belum ada paket jasa. Tambahkan melalui menu Paket Jasa di dashboard.', 'crediblecompany' ); ?>
            </p>
        <?php endif; ?>
        <?php wp_reset_postdata(); ?>
    </div>
</section>
