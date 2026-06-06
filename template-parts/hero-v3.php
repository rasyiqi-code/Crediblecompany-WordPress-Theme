<?php
/**
 * Bagian Template: Section Hero - Varian 3 (Gaya Terpusat Jasper AI)
 * Desain terpusat dengan promo badge di atas, visual grafis grid hijau di bawah teks,
 * dengan ornamen melayang dan logo mitra sebagai social proof.
 *
 * @package CredibleCompany
 */

$hero_title      = cc_get( 'hero_title', 'Lorem Ipsum Dolor Sit Amet' );
$hero_desc       = cc_get( 'hero_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam, nec imperdiet elit tempor ut. Duis lobortis scelerisque nisi.' );
$hero_image      = cc_img( 'hero_v3_image', cc_placeholder_svg( 500, 400, 'c01314', 'ffffff', 'Hero Image' ) );
$hero_ornament_1 = cc_get( 'hero_v3_ornament_1', '💡' );
$hero_ornament_2 = cc_get( 'hero_v3_ornament_2', '📈' );

// Teks promo / pengumuman V3
$promo_text      = cc_get( 'hero_v3_promo_text', 'New! Introducing the new Jasper: Canvas, Agents, and a bold rebrand.' );
$promo_url       = cc_get( 'hero_v3_promo_url', '#' );
$promo_tag       = cc_get( 'hero_v3_promo_tag', 'New!' );

// Pengaturan Kartu Melayang & Kredibilitas V3
$card_left_icon  = cc_get( 'hero_v3_card_left_icon', '🔴' );
$card_left_text  = cc_get( 'hero_v3_card_left_text', 'Buat 6.000 email super-personal dalam hitungan menit' );
$card_right_num  = cc_get( 'hero_v3_card_right_num', '11x' );
$card_right_text = cc_get( 'hero_v3_card_right_text', 'rasio klik-tayang' );
$partners_title  = cc_get( 'hero_v3_partners_title', 'Dipercaya oleh tim pemasaran kelas dunia' );

// Tombol CTA V3
$btn1_enable     = cc_get( 'hero_v3_btn1_enable', true );
$btn1_text       = cc_get( 'hero_v3_btn1_text', 'Start Trial' );
$btn1_url        = cc_get( 'hero_v3_btn1_url', '#daftar' );
$btn1_bg_color   = cc_get( 'hero_v3_btn1_bg_color', 'transparent' );
$btn1_text_color = cc_get( 'hero_v3_btn1_text_color', '#0f172a' );

$btn2_enable     = cc_get( 'hero_v3_btn2_enable', true );
$btn2_text       = cc_get( 'hero_v3_btn2_text', 'How It Works' );
$btn2_url        = cc_get( 'hero_v3_btn2_url', '#how-it-works' );
$btn2_bg_color   = cc_get( 'hero_v3_btn2_bg_color', '#ff4f38' );
$btn2_text_color = cc_get( 'hero_v3_btn2_text_color', '#ffffff' );

$btn_shape       = cc_get( 'hero_v3_btn_shape', '50px' );
?>

<section class="hero-section hero-v3-section section-divider-bottom" id="hero">
    <div class="container hero-v3-container">
        
        <!-- 1. Badge Promo (Pengumuman) -->
        <?php if ( ! empty( $promo_text ) ) : ?>
            <div class="hero-v3-promo-wrapper">
                <a href="<?php echo esc_url( $promo_url ); ?>" class="hero-v3-promo-badge">
                    <span class="promo-badge-tag"><?php echo esc_html( $promo_tag ); ?></span>
                    <span class="promo-badge-text"><?php echo esc_html( $promo_text ); ?></span>
                    <span class="promo-badge-arrow">&rarr;</span>
                </a>
            </div>
        <?php endif; ?>

        <!-- 2. Konten Terpusat (Centered) -->
        <div class="hero-v3-text-content">
            <h1 class="hero-v3-title">
                <?php 
                // Pecah kata terakhir untuk efek serif premium
                $words = explode( " ", esc_html( $hero_title ) );
                if ( count( $words ) > 1 ) {
                    $last_word = array_pop( $words );
                    echo implode( " ", $words ) . ' <span class="highlight-text-v3">' . $last_word . '</span>';
                } else {
                    echo esc_html( $hero_title );
                }
                ?>
            </h1>
            
            <p class="hero-v3-desc"><?php echo esc_html( $hero_desc ); ?></p>
            
            <div class="hero-v3-buttons">
                <?php if ( $btn1_enable ) : ?>
                    <a href="<?php echo esc_url( $btn1_url ); ?>" 
                       class="button button-outline hero-btn-v3" 
                       style="background-color: <?php echo esc_attr( $btn1_bg_color ); ?>; border-color: <?php echo esc_attr( $btn1_text_color ); ?>; color: <?php echo esc_attr( $btn1_text_color ); ?>; border-radius: <?php echo esc_attr( $btn_shape ); ?>;">
                        <?php echo esc_html( $btn1_text ); ?>
                    </a>
                <?php endif; ?>
                
                <?php if ( $btn2_enable ) : ?>
                    <a href="<?php echo esc_url( $btn2_url ); ?>" 
                       class="button button-primary hero-btn-v3" 
                       style="background-color: <?php echo esc_attr( $btn2_bg_color ); ?>; border-color: <?php echo esc_attr( $btn2_bg_color ); ?>; color: <?php echo esc_attr( $btn2_text_color ); ?>; border-radius: <?php echo esc_attr( $btn_shape ); ?>;">
                        <?php echo esc_html( $btn2_text ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- 3. Area Grafis Visual -->
        <div class="hero-v3-visual-canvas">
            <!-- Pola Grid Hijau Terang -->
            <div class="hero-v3-grid-pattern"></div>

            <div class="hero-v3-visual-inner">
                <!-- Foto Model Utama -->
                <img src="<?php echo $hero_image; ?>" alt="<?php echo esc_attr( $hero_title ); ?>" class="hero-v3-main-img">

                <!-- Ornamen Melayang Kiri: Segitiga Pink Miring + Kartu Teks -->
                <div class="floating-shape-v3 shape-v3-pink-triangle"></div>
                <div class="floating-card-v3 card-v3-left">
                    <span class="card-dot-red"><?php echo esc_html( $card_left_icon ); ?></span>
                    <span class="card-text"><?php echo esc_html( $card_left_text ); ?></span>
                </div>

                <!-- Ornamen Melayang Kanan: Badge Biru "11x rasio klik-tayang" -->
                <div class="floating-card-v3 card-v3-right">
                    <div class="rate-number"><?php echo esc_html( $card_right_num ); ?></div>
                    <div class="rate-label"><?php echo esc_html( $card_right_text ); ?></div>
                </div>

                <!-- Kolom berisi 3 Lingkaran Hijau (Kanan) -->
                <div class="floating-shape-v3 shape-v3-circle-column">
                    <span class="circle-item"></span>
                    <span class="circle-item"></span>
                    <span class="circle-item"></span>
                </div>

                <!-- Aksen Garis Biru Miring -->
                <div class="floating-shape-v3 shape-v3-blue-bars">
                    <span class="bar-item"></span>
                    <span class="bar-item"></span>
                    <span class="bar-item"></span>
                </div>

                <!-- Lingkaran Hijau Solid di bawah -->
                <div class="floating-shape-v3 shape-v3-green-circle-bottom"></div>
            </div>

            <!-- Pembatas Masker Bergerigi (Jagged Mask Border) di bawah kanvas -->
            <div class="hero-v3-jagged-bottom">
                <div class="jagged-step step-1"></div>
                <div class="jagged-step step-2"></div>
                <div class="jagged-step step-3"></div>
                <div class="jagged-step step-4"></div>
                <div class="jagged-step step-5"></div>
            </div>
        </div>

        <!-- 4. Logo Kredibilitas Mitra / Partners -->
        <div class="hero-v3-partners">
            <h3 class="partners-title"><?php echo esc_html( $partners_title ); ?></h3>
            <div class="partners-logos-container">
                <?php
                $mitra_logos = array();
                for ( $i = 1; $i <= 6; $i++ ) {
                    $logo_url = cc_get( "mitra_logo_{$i}", '' );
                    if ( ! empty( $logo_url ) ) {
                        $mitra_logos[] = $logo_url;
                    }
                }
                
                if ( ! empty( $mitra_logos ) ) {
                    foreach ( $mitra_logos as $index => $logo ) {
                        echo '<div class="partner-logo-item"><img src="' . esc_url( $logo ) . '" alt="Partner Logo"></div>';
                    }
                } else {
                    // Placeholder logo cadangan dalam skala abu-abu jika kosong
                    $fallbacks = array( 'wayfair', 'BOEING', 'alliantgroup', 'CUSHMAN & WAKEFIELD', 'Cox AUTOMOTIVE', 'ANTHROPOLOGIE' );
                    foreach ( $fallbacks as $fb ) {
                        echo '<span class="partner-logo-text">' . esc_html( $fb ) . '</span>';
                    }
                }
                ?>
            </div>
        </div>

    </div>
</section>
