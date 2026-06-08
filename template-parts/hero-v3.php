<?php
/**
 * Bagian Template: Section Hero - Varian 3 (Gaya Minimalis Editorial Modern)
 * Desain minimalis mewah dengan navigasi mini di atas, judul editorial besar,
 * deskripsi bersih, dan tombol aksi premium.
 *
 * @package CredibleCompany
 */

// Mengambil variabel teks dengan fallback dari data Figma yang diberikan
$hero_title      = cc_get( 'hero_title', 'Delightful remarkably mr on announcing themselves entreaties favourable.' );
$hero_desc       = cc_get( 'hero_desc', 'Of on affixed civilly moments promise explain fertile in. Assurance advantage belonging happiness departure so of. Now improving and one sincerity intention allowance.' );

// Menu navigasi mini di bagian atas Hero V3
$hero_v3_menu = array(
    array( 'text' => 'HOME', 'url' => home_url( '/' ) ),
    array( 'text' => 'About Us', 'url' => '#about' ),
    array( 'text' => 'Contact Us', 'url' => '#contact' ),
    array( 'text' => 'Barrel', 'url' => '#barrel' ),
    array( 'text' => 'Design', 'url' => '#design' ),
    array( 'text' => 'Culture', 'url' => '#culture' ),
);
$hero_v3_menu = apply_filters( 'cc_hero_v3_menu', $hero_v3_menu );

// Pengaturan tombol CTA Hero V3
$btn1_enable     = cc_get( 'hero_v3_btn1_enable', true );
$btn1_text       = cc_get( 'hero_v3_btn1_text', 'Read More' );
$btn1_url        = cc_get( 'hero_v3_btn1_url', '#about' );
$btn1_bg_color   = cc_get( 'hero_v3_btn1_bg_color', 'transparent' );
$btn1_text_color = cc_get( 'hero_v3_btn1_text_color', '#1f2937' ); // Warna abu-abu gelap

$btn2_enable     = cc_get( 'hero_v3_btn2_enable', true );
$btn2_text       = cc_get( 'hero_v3_btn2_text', 'Explore Collection' );
$btn2_url        = cc_get( 'hero_v3_btn2_url', '#explore' );
$btn2_bg_color   = cc_get( 'hero_v3_btn2_bg_color', '#c01314' ); // Warna merah brand
$btn2_text_color = cc_get( 'hero_v3_btn2_text_color', '#ffffff' );

$btn_shape       = cc_get( 'hero_v3_btn_shape', '4px' ); // Bentuk tombol yang lebih bersudut (minimalis)
?>

<section class="hero-section hero-v3-section" id="hero">
    <div class="container hero-v3-container">
        
        <!-- 1. Navigasi Mini di Atas Hero -->
        <?php if ( ! empty( $hero_v3_menu ) ) : ?>
            <nav class="hero-v3-mini-nav" aria-label="Hero Navigation">
                <ul class="hero-v3-mini-nav-list">
                    <?php foreach ( $hero_v3_menu as $item ) : ?>
                        <li class="hero-v3-mini-nav-item">
                            <a href="<?php echo esc_url( $item['url'] ); ?>" class="hero-v3-mini-nav-link">
                                <?php echo esc_html( $item['text'] ); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        <?php endif; ?>

        <!-- 2. Konten Utama Terpusat (Centered) -->
        <div class="hero-v3-text-content">
            <h1 class="hero-v3-title">
                <?php 
                // Memisahkan kata terakhir untuk diberikan kelas khusus font serif miring agar terlihat elegan
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
                       class="button hero-btn-v3 hero-btn-v3-outline" 
                       style="background-color: <?php echo esc_attr( $btn1_bg_color ); ?>; border-color: <?php echo esc_attr( $btn1_text_color ); ?>; color: <?php echo esc_attr( $btn1_text_color ); ?>; border-radius: <?php echo esc_attr( $btn_shape ); ?>;">
                        <?php echo esc_html( $btn1_text ); ?>
                    </a>
                <?php endif; ?>
                
                <?php if ( $btn2_enable ) : ?>
                    <a href="<?php echo esc_url( $btn2_url ); ?>" 
                       class="button hero-btn-v3 hero-btn-v3-primary" 
                       style="background-color: <?php echo esc_attr( $btn2_bg_color ); ?>; border-color: <?php echo esc_attr( $btn2_bg_color ); ?>; color: <?php echo esc_attr( $btn2_text_color ); ?>; border-radius: <?php echo esc_attr( $btn_shape ); ?>;">
                        <?php echo esc_html( $btn2_text ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>
