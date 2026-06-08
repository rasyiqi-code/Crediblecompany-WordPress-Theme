<?php
/**
 * Bagian Template: Section Hero - Varian 3 (Gaya Split Grid & Editorial Figma)
 * Desain asimetris dengan mosaic grid foto 4x4 di kiri, judul besar DESIGN CULTURE di kanan,
 * dan layout detail dua kolom di bawahnya.
 *
 * @package CredibleCompany
 */

// Mengambil variabel teks dengan fallback dari data Figma
$hero_title      = cc_get( 'hero_title', 'Delightful remarkably mr on announcing themselves entreaties favourable.' );
$hero_desc       = cc_get( 'hero_desc', 'Of on affixed civilly moments promise explain fertile in. Assurance advantage belonging happiness departure so of. Now improving and one sincerity intention allowance.' );
$hero_image      = cc_img( 'hero_v3_image', get_template_directory_uri() . '/assets/images/hero_v3_model.png' );

// Tombol CTA V3
$btn1_enable     = cc_get( 'hero_v3_btn1_enable', true );
$btn1_text       = cc_get( 'hero_v3_btn1_text', 'Read More' );
$btn1_url        = cc_get( 'hero_v3_btn1_url', '#about' );

$btn2_enable     = cc_get( 'hero_v3_btn2_enable', true );
$btn2_text       = cc_get( 'hero_v3_btn2_text', 'EXPLORE COLLECTION' );
$btn2_url        = cc_get( 'hero_v3_btn2_url', '#explore' );
?>

<section class="hero-section hero-v3-section" id="hero">
    <div class="container hero-v3-container">
        
        <!-- Sisi Kiri: Mosaic Grid Foto -->
        <div class="hero-v3-left-side">
            <div class="hero-v3-mosaic-container">
                <!-- Foto Model Utama di belakang grid -->
                <img src="<?php echo esc_url( $hero_image ); ?>" alt="Hero Model" class="hero-v3-mosaic-bg">
                
                <!-- Overlay Grid 4x4 dengan pembatas putih -->
                <div class="hero-v3-mosaic-grid">
                    <?php for ( $i = 1; $i <= 16; $i++ ) : ?>
                        <div class="hero-v3-grid-cell cell-<?php echo $i; ?>"></div>
                    <?php endfor; ?>
                </div>
            </div>
            
            <!-- Kotak kuning aksen melayang yang menjorok keluar di sisi kiri -->
            <div class="hero-v3-accent-yellow"></div>
            
            <!-- Tombol Scroll Down Offset di kiri bawah -->
            <div class="hero-v3-scroll-down">
                <div class="scroll-down-box-bg"></div>
                <div class="scroll-down-box">
                    <span class="scroll-arrow">&darr;</span>
                </div>
            </div>
        </div>

        <!-- Sisi Kanan: Judul & Detail Kolom -->
        <div class="hero-v3-right-side">
            <!-- Judul Kategori Raksasa -->
            <h1 class="hero-v3-main-title">
                <span class="title-line-1">DESIGN</span>
                <span class="title-line-2">CULTURE</span>
            </h1>
            
            <!-- Detail Layout Dua Kolom -->
            <div class="hero-v3-details-grid">
                <!-- Kolom Kiri: Headline & Tombol Explore -->
                <div class="hero-v3-col-left">
                    <h2 class="hero-v3-headline"><?php echo esc_html( $hero_title ); ?></h2>
                    
                    <?php if ( $btn2_enable ) : ?>
                        <div class="hero-v3-action-wrapper">
                            <a href="<?php echo esc_url( $btn2_url ); ?>" class="hero-btn-v3-explore">
                                <?php echo esc_html( $btn2_text ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                
                <!-- Kolom Kanan: Deskripsi Paragraf & Read More -->
                <div class="hero-v3-col-right">
                    <p class="hero-v3-paragraph"><?php echo esc_html( $hero_desc ); ?></p>
                    
                    <?php if ( $btn1_enable ) : ?>
                        <div class="hero-v3-readmore-wrapper">
                            <a href="<?php echo esc_url( $btn1_url ); ?>" class="hero-btn-v3-readmore">
                                <?php echo esc_html( $btn1_text ); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</section>

