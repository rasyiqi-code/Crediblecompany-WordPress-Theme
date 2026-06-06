<?php
/**
 * Template Part: Hero Section - Variant 3 (Split Glass Layout)
 * Visual & Shapes di kiri, teks/konten di dalam Card Glassmorphism di kanan.
 *
 * @package CredibleCompany
 */

$hero_title = cc_get( 'hero_title', 'Lorem Ipsum Dolor Sit Amet' );
$hero_desc       = cc_get( 'hero_desc', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam, nec imperdiet elit tempor ut. Duis lobortis scelerisque nisi.' );
$hero_image      = cc_img( 'hero_image', cc_placeholder_svg( 500, 400, 'c01314', 'ffffff', 'Hero Image' ) );
$hero_ornament_1 = cc_get( 'hero_ornament_1', '💡' );
$hero_ornament_2 = cc_get( 'hero_ornament_2', '📈' );

// Tombol CTA
$btn1_enable     = cc_get( 'hero_btn1_enable', true );
$btn1_text       = cc_get( 'hero_btn1_text', 'Start Trial' );
$btn1_url        = cc_get( 'hero_btn1_url', '#daftar' );
$btn1_bg_color   = cc_get( 'hero_btn1_bg_color', '#1d4ed8' );
$btn1_text_color = cc_get( 'hero_btn1_text_color', '#ffffff' );

$btn2_enable     = cc_get( 'hero_btn2_enable', true );
$btn2_text       = cc_get( 'hero_btn2_text', 'How It Works' );
$btn2_url        = cc_get( 'hero_btn2_url', '#how-it-works' );
$btn2_bg_color   = cc_get( 'hero_btn2_bg_color', 'transparent' );
$btn2_text_color = cc_get( 'hero_btn2_text_color', '#1d4ed8' );

$btn_shape       = cc_get( 'hero_btn_shape', '50px' );

// Warna bentuk latar
$bg_shape_image = cc_img( 'hero_shape_bg_image', '' );
$color_main   = cc_get( 'hero_shape_main_color', '#ea580c' );
$color_yellow = cc_get( 'hero_shape_yellow_color', '#EAB308' );
$color_blue   = cc_get( 'hero_shape_blue_color', '#3B82F6' );
$color_red    = cc_get( 'hero_shape_red_color', '#EF4444' );
$color_purple = cc_get( 'hero_shape_purple_color', '#8B5CF6' );
?>

<section class="hero-section hero-v3-section section-divider-bottom" id="hero">
    <!-- Background Ambient Glow -->
    <div class="hero-v3-glow" style="background: radial-gradient(circle, <?php echo esc_attr( $color_red ); ?>1F 0%, transparent 60%);"></div>

    <div class="container hero-v3-container">
        <!-- Area Gambar Kiri (Visual & Parallax) -->
        <div class="hero-v3-visual">
            <div class="hero-v3-visual-inner">
                <!-- Background Circle Utama Oren / Image -->
                <?php if ( ! empty( $bg_shape_image ) ) : ?>
                    <img src="<?php echo esc_url( $bg_shape_image ); ?>" alt="Hero Background Shape" class="hero-v3-bg-circle hero-v3-bg-image">
                <?php else : ?>
                    <div class="hero-v3-bg-circle" style="background-color: <?php echo esc_attr( $color_purple ); ?>;"></div>
                <?php endif; ?>

                <!-- Gambar Utama -->
                <img src="<?php echo $hero_image; ?>" alt="<?php echo esc_attr( $hero_title ); ?>" class="hero-v3-main-img">

                <!-- Ornamen Melayang -->
                <div class="floating-shape-v3 shape-v3-orn-1 morph-fast">
                    <span style="font-size: 3rem;"><?php echo esc_html( $hero_ornament_1 ); ?></span>
                </div>
                <div class="floating-shape-v3 shape-v3-orn-2 morph-slow">
                    <span style="font-size: 3rem;"><?php echo esc_html( $hero_ornament_2 ); ?></span>
                </div>
                <div class="floating-shape-v3 shape-v3-blue" style="background-color: <?php echo esc_attr( $color_blue ); ?>;"></div>
                <div class="floating-shape-v3 shape-v3-yellow" style="background-color: <?php echo esc_attr( $color_yellow ); ?>;"></div>
            </div>
        </div>

        <!-- Area Teks Kanan (Card Glassmorphism) -->
        <div class="hero-v3-content-wrapper">
            <div class="hero-v3-glass-card">
                <h1 class="hero-v3-title">
                    <?php 
                    $words = explode( " ", esc_html( $hero_title ) );
                    if ( count( $words ) > 1 ) {
                        $last_word = array_pop( $words );
                        echo implode( " ", $words ) . ' <span class="highlight-text-v3" style="color: ' . esc_attr( $color_main ) . ';">' . $last_word . '</span>';
                    } else {
                        echo esc_html( $hero_title );
                    }
                    ?>
                </h1>
                
                <p class="hero-v3-desc"><?php echo esc_html( $hero_desc ); ?></p>
                
                <div class="hero-v3-buttons">
                    <?php if ( $btn1_enable ) : ?>
                        <a href="<?php echo esc_url( $btn1_url ); ?>" 
                           class="button button-primary hero-btn-v3" 
                           style="background-color: <?php echo esc_attr( $btn1_bg_color ); ?>; color: <?php echo esc_attr( $btn1_text_color ); ?>; border-color: <?php echo esc_attr( $btn1_bg_color ); ?>; border-radius: <?php echo esc_attr( $btn_shape ); ?>;">
                            <?php echo esc_html( $btn1_text ); ?>
                        </a>
                    <?php endif; ?>
                    
                    <?php if ( $btn2_enable ) : ?>
                        <a href="<?php echo esc_url( $btn2_url ); ?>" 
                           class="button button-outline hero-btn-v3" 
                           style="background-color: <?php echo esc_attr( $btn2_bg_color ); ?>; color: <?php echo esc_attr( $btn2_text_color ); ?>; border-color: <?php echo esc_attr( $btn2_text_color ); ?>; border-radius: <?php echo esc_attr( $btn_shape ); ?>;">
                            <?php echo esc_html( $btn2_text ); ?>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Statistik di dalam Glass Card -->
                <div class="hero-v3-stats">
                    <?php
                    $num_color   = cc_get( 'stat_number_color', '#F59E0B' );
                    $label_color = cc_get( 'stat_label_color', '#475569' );
                    
                    for ( $i = 1; $i <= 3; $i++ ) :
                        $number = cc_get( "stat_number_{$i}", '' );
                        $label  = cc_get( "stat_label_{$i}", '' );
                        if ( empty( $number ) && empty( $label ) ) {
                            $defaults = [ 
                                1 => ['1,200+', 'Lorem Ipsum'], 
                                2 => ['85,000+', 'Dolor Sit'], 
                                3 => ['4,500+', 'Consectetur'] 
                            ];
                            $number = $defaults[$i][0];
                            $label = $defaults[$i][1];
                        }
                    ?>
                        <div class="hero-v3-stat-item">
                            <h3 class="stat-number" style="color: <?php echo esc_attr( $num_color ); ?>;"><?php echo esc_html( $number ); ?></h3>
                            <p class="stat-label" style="color: <?php echo esc_attr( $label_color ); ?>;"><?php echo esc_html( $label ); ?></p>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</section>
