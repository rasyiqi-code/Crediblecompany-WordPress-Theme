<?php
/**
 * Template Part: Statistics Section.
 * Menampilkan angka statistik dalam bentuk grid 3 kolom secara mandiri.
 *
 * @package CredibleCompany
 */

// Mencegah akses langsung
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<section class="statistics" id="statistics">
    <div class="container">
        <div class="stats-grid">
            <?php
            for ( $i = 1; $i <= 3; $i++ ) :
                $number = cc_get( "stat_number_{$i}", '' );
                $label  = cc_get( "stat_label_{$i}", '' );
                
                // Fallback default jika data di Customizer kosong
                if ( empty( $number ) && empty( $label ) ) {
                    $defaults = [
                        1 => ['1,200+', 'Lorem Ipsum'],
                        2 => ['85,000+', 'Dolor Sit'],
                        3 => ['4,500+', 'Consectetur']
                    ];
                    $number = $defaults[$i][0];
                    $label  = $defaults[$i][1];
                }
            ?>
                <div class="stat-item">
                    <h2><?php echo esc_html( $number ); ?></h2>
                    <p><?php echo esc_html( $label ); ?></p>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>
