<?php
/**
 * Template Part: Statistics Section.
 * Menampilkan angka statistik secara dinamis.
 *
 * @package CredibleCompany
 */

// Mencegah akses langsung
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Cek apakah section statistik aktif
$stats_enable = cc_get( 'stats_enable', true );
if ( ! $stats_enable ) {
    return;
}

// Ambil jumlah stats yang disetel di Customizer
$stats_count = intval( cc_get( 'stats_count', 3 ) );

// Fallback defaults jika data di Customizer kosong
$defaults = [
    1 => ['1,200+', 'Lorem Ipsum'],
    2 => ['85,000+', 'Dolor Sit'],
    3 => ['4,500+', 'Consectetur'],
    4 => ['500+', 'Mitra Resmi'],
    5 => ['100k', 'Pengguna Aktif'],
    6 => ['99%', 'Tingkat Kepuasan']
];
?>

<section class="statistics" id="statistics">
    <div class="container">
        <div class="stats-grid">
            <?php
            for ( $i = 1; $i <= $stats_count; $i++ ) :
                $number = cc_get( "stat_number_{$i}", '' );
                $label  = cc_get( "stat_label_{$i}", '' );
                
                // Gunakan default jika data kosong
                if ( empty( $number ) && empty( $label ) && isset( $defaults[$i] ) ) {
                    $number = $defaults[$i][0];
                    $label  = $defaults[$i][1];
                }
                
                // Tampilkan hanya jika ada data angka atau label
                if ( ! empty( $number ) || ! empty( $label ) ) :
            ?>
                <div class="stat-item">
                    <h2><?php echo esc_html( $number ); ?></h2>
                    <p><?php echo esc_html( $label ); ?></p>
                </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>
</section>

