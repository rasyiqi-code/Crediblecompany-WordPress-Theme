<?php
/**
 * Template Part: Hero Section.
 * Data diambil dari Customizer (cc_hero_*).
 *
 * @package CredibleCompany
 */

$hero_title = cc_get( 'hero_title', 'Bukumu Segera Terbit!' );
$hero_desc       = cc_get( 'hero_desc', 'Penerbit KBM mempersembahkan lebih dari 3000 judul buku. Yuk, wujudkan mimpimu menjadi penulis — jadikan nyata naskah ceritamu.' );
$hero_image      = cc_img( 'hero_image', 'https://via.placeholder.com/500x400.png/c01314/fff?text=Model+KBM' );
$hero_ornament_1 = cc_get( 'hero_ornament_1', '📚' );
$hero_ornament_2 = cc_get( 'hero_ornament_2', '🎓' );

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

<section class="hero-section section-divider-bottom" id="hero-kbm">
    <div class="container hero-container">
        <!-- Area Teks Kiri -->
        <div class="hero-content">
            <h1 class="hero-title">
                <?php 
                // Pecah judul untuk styling khusus kata terakhir jika memungkinkan
                $words = explode(" ", esc_html( $hero_title ));
                if(count($words) > 1) {
                    $last_word = array_pop($words);
                    echo implode(" ", $words) . ' <span class="highlight-text">' . $last_word . '</span>';
                } else {
                    echo esc_html( $hero_title );
                }
                ?>
            </h1>
            
            <p class="hero-desc"><?php echo esc_html( $hero_desc ); ?></p>
            
            <div class="hero-buttons">
                <?php if ( $btn1_enable ) : ?>
                    <a href="<?php echo esc_url( $btn1_url ); ?>" 
                       class="button button-primary hero-btn" 
                       style="background-color: <?php echo esc_attr( $btn1_bg_color ); ?>; color: <?php echo esc_attr( $btn1_text_color ); ?>; border-color: <?php echo esc_attr( $btn1_bg_color ); ?>; border-radius: <?php echo esc_attr( $btn_shape ); ?>;">
                        <?php echo esc_html( $btn1_text ); ?>
                    </a>
                <?php endif; ?>
                
                <?php if ( $btn2_enable ) : ?>
                    <a href="<?php echo esc_url( $btn2_url ); ?>" 
                       class="button button-outline hero-btn" 
                       style="background-color: <?php echo esc_attr( $btn2_bg_color ); ?>; color: <?php echo esc_attr( $btn2_text_color ); ?>; border-color: <?php echo esc_attr( $btn2_text_color ); ?>; border-radius: <?php echo esc_attr( $btn_shape ); ?>;">
                        <?php echo esc_html( $btn2_text ); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Area Angka Statistik Inline (Dipindah dari statistics.php) -->
            <div class="hero-stats">
                <?php
                $num_color   = cc_get( 'stat_number_color', '#F59E0B' );
                $label_color = cc_get( 'stat_label_color', '#1e293b' );
                
                for ( $i = 1; $i <= 3; $i++ ) :
                    $number = cc_get( "stat_number_{$i}", '' );
                    $label  = cc_get( "stat_label_{$i}", '' );
                    if ( empty( $number ) && empty( $label ) ) {
                        // Data stat default sebagai fallback jika Customizer kosong
                        $defaults = [ 1 => ['1000+', 'Courses to choose from'], 2 => ['5000+', 'Students Trained'], 3 => ['200+', 'Professional Trainers'] ];
                        $number = $defaults[$i][0];
                        $label = $defaults[$i][1];
                    }
                ?>
                    <div class="hero-stat-item">
                        <h3 class="stat-number" style="color: <?php echo esc_attr( $num_color ); ?>;"><?php echo esc_html( $number ); ?></h3>
                        <p class="stat-label" style="color: <?php echo esc_attr( $label_color ); ?>;"><?php echo esc_html( $label ); ?></p>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <!-- Area Gambar Kanan (Visual & Parallax) -->
        <div class="hero-visual">
            <div class="hero-visual-inner">
                <!-- Background Circle Utama Oren / Image -->
                <?php if ( ! empty( $bg_shape_image ) ) : ?>
                    <img src="<?php echo esc_url( $bg_shape_image ); ?>" alt="Hero Background Shape" class="hero-bg-circle hero-bg-image">
                <?php else : ?>
                    <div class="hero-bg-circle" style="background-color: <?php echo esc_attr( $color_main ); ?>;"></div>
                <?php endif; ?>

                <!-- Gambar Utama / Model -->
                <img src="<?php echo esc_url( $hero_image ); ?>" alt="<?php echo esc_attr( $hero_title ); ?>" class="hero-main-img">

                <!-- Ornamen Abstrak (Micro interactions) -->
                <!-- Shape 1: Roket/Elemen Melayang 1 (Kiri Atas) -->
                <div class="floating-shape shape-rocket morph-fast">
                    <span style="font-size:3rem;"><?php echo esc_html( $hero_ornament_1 ); ?></span>
                </div>
                <!-- Shape 2: Piala/Elemen Melayang 2 (Kanan Bawah) -->
                <div class="floating-shape shape-trophy morph-slow">
                    <span style="font-size:3.5rem;"><?php echo esc_html( $hero_ornament_2 ); ?></span>
                </div>
                <!-- Shape 3: Lingkaran Ungu Besar -->
                <div class="floating-shape shape-purple-circle" style="background-color: <?php echo esc_attr( $color_purple ); ?>;"></div>
                <!-- Shape 4: Lingkaran Merah Kecil -->
                <div class="floating-shape shape-red-circle" style="background-color: <?php echo esc_attr( $color_red ); ?>;"></div>
                <!-- Shape 5: Blob/Lingkaran Biru & Kuning Kiri Bawah -->
                <div class="floating-shape shape-blue-circle" style="background-color: <?php echo esc_attr( $color_blue ); ?>;"></div>
                <div class="floating-shape shape-yellow-blob" style="background-color: <?php echo esc_attr( $color_yellow ); ?>;"></div>
            </div>
        </div>
    </div>
</section>
