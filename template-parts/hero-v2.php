<?php
/**
 * Template Part: Hero Section - Variant 2 (Centered Layout)
 * Teks tengah, gradient latar, tanpa gambar utama, dengan ornamen melayang.
 *
 * @package CredibleCompany
 */

$hero_title      = cc_get( 'hero_title', 'Lorem Ipsum Dolor Sit Amet' );
$hero_desc       = cc_get( 'hero_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam, nec imperdiet elit tempor ut. Duis lobortis scelerisque nisi.' );
$hero_ornament_1 = cc_get( 'hero_v2_ornament_1', '🚀' );
$hero_ornament_2 = cc_get( 'hero_v2_ornament_2', '✨' );
$hero_ornament_3 = cc_get( 'hero_v2_ornament_3', '🎓' );
$badge_text      = cc_get( 'hero_v2_badge_text', 'Solusi Terpercaya & Modern' );

// Tombol CTA V2
$btn1_enable     = cc_get( 'hero_v2_btn1_enable', true );
$btn1_text       = cc_get( 'hero_v2_btn1_text', 'Start Trial' );
$btn1_url        = cc_get( 'hero_v2_btn1_url', '#daftar' );
$btn1_bg_color   = cc_get( 'hero_v2_btn1_bg_color', '#1d4ed8' );
$btn1_text_color = cc_get( 'hero_v2_btn1_text_color', '#ffffff' );

$btn2_enable     = cc_get( 'hero_v2_btn2_enable', true );
$btn2_text       = cc_get( 'hero_v2_btn2_text', 'How It Works' );
$btn2_url        = cc_get( 'hero_v2_btn2_url', '#how-it-works' );
$btn2_bg_color   = cc_get( 'hero_v2_btn2_bg_color', 'transparent' );
$btn2_text_color = cc_get( 'hero_v2_btn2_text_color', '#1d4ed8' );

$btn_shape       = cc_get( 'hero_v2_btn_shape', '50px' );

// Warna bentuk latar khusus V2
$color_main     = cc_get( 'hero_v2_shape_main_color', '#ea580c' );
$color_yellow   = cc_get( 'hero_v2_shape_yellow_color', '#EAB308' );
$color_blue     = cc_get( 'hero_v2_shape_blue_color', '#3B82F6' );
$color_red      = cc_get( 'hero_v2_shape_red_color', '#EF4444' );
$color_purple   = cc_get( 'hero_v2_shape_purple_color', '#8B5CF6' );
?>

<section class="hero-section hero-v2-section section-divider-bottom" id="hero">
    <!-- Efek Ambient Glow / Gradient Latar Belakang -->
    <div class="hero-v2-glow-1" style="background: radial-gradient(circle, <?php echo esc_attr( $color_blue ); ?>33 0%, transparent 70%);"></div>
    <div class="hero-v2-glow-2" style="background: radial-gradient(circle, <?php echo esc_attr( $color_purple ); ?>33 0%, transparent 70%);"></div>

    <div class="container hero-v2-container">
        <!-- Badge Ornamen / Pengumuman Kecil -->
        <div class="hero-v2-badge">
            <span class="hero-v2-badge-icon"><?php echo esc_html( $hero_ornament_1 ); ?></span>
            <span class="hero-v2-badge-text"><?php echo esc_html( $badge_text ); ?></span>
        </div>

        <!-- Judul Utama -->
        <h1 class="hero-v2-title">
            <?php 
            $words = explode( " ", esc_html( $hero_title ) );
            if ( count( $words ) > 1 ) {
                $last_word = array_pop( $words );
                echo implode( " ", $words ) . ' <span class="highlight-text-v2" style="background: linear-gradient(135deg, ' . esc_attr( $color_main ) . ', ' . esc_attr( $color_yellow ) . '); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">' . $last_word . '</span>';
            } else {
                echo esc_html( $hero_title );
            }
            ?>
        </h1>

        <!-- Deskripsi -->
        <p class="hero-v2-desc"><?php echo esc_html( $hero_desc ); ?></p>

        <!-- Tombol Aksi -->
        <div class="hero-v2-buttons">
            <?php if ( $btn1_enable ) : ?>
                <a href="<?php echo esc_url( $btn1_url ); ?>" 
                   class="button button-primary hero-btn-v2" 
                   style="background-color: <?php echo esc_attr( $btn1_bg_color ); ?>; color: <?php echo esc_attr( $btn1_text_color ); ?>; border-color: <?php echo esc_attr( $btn1_bg_color ); ?>; border-radius: <?php echo esc_attr( $btn_shape ); ?>;">
                    <?php echo esc_html( $btn1_text ); ?>
                </a>
            <?php endif; ?>
            
            <?php if ( $btn2_enable ) : ?>
                <a href="<?php echo esc_url( $btn2_url ); ?>" 
                   class="button button-outline hero-btn-v2" 
                   style="background-color: <?php echo esc_attr( $btn2_bg_color ); ?>; color: <?php echo esc_attr( $btn2_text_color ); ?>; border-color: <?php echo esc_attr( $btn2_text_color ); ?>; border-radius: <?php echo esc_attr( $btn_shape ); ?>;">
                    <?php echo esc_html( $btn2_text ); ?>
                </a>
            <?php endif; ?>
        </div>


    </div>

    <!-- Bentuk Ornamen Melayang Kiri & Kanan -->
    <div class="floating-shape-v2 shape-left-1 morph-slow" style="background-color: <?php echo esc_attr( $color_red ); ?>1A;">
        <span style="font-size: 2.5rem;"><?php echo esc_html( $hero_ornament_2 ); ?></span>
    </div>
    <div class="floating-shape-v2 shape-right-1 morph-fast" style="background-color: <?php echo esc_attr( $color_purple ); ?>1A;">
        <span style="font-size: 3rem;"><?php echo esc_html( $hero_ornament_3 ); ?></span>
    </div>
    <div class="floating-shape-v2 shape-left-2" style="background-color: <?php echo esc_attr( $color_yellow ); ?>;"></div>
    <div class="floating-shape-v2 shape-right-2" style="background-color: <?php echo esc_attr( $color_blue ); ?>;"></div>
</section>
