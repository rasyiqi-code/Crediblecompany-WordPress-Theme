<?php
/**
 * Template Part: Features Section (Mengapa Memilih Kami).
 * 6 fitur dari Customizer (cc_feat_*).
 *
 * @package CredibleCompany
 */

// Pustaka Ikon SVG lengkap
$icon_library = array(
    'user'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>',
    'dollar'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
    'lightning' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>',
    'mail'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
    'shield'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>',
    'globe'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>',
    'award'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>',
    'chart'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"/>',
    'gear'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>',
    'clock'     => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>',
);

$icon_defaults = array(
    1 => 'user',
    2 => 'dollar',
    3 => 'lightning',
    4 => 'mail',
    5 => 'shield',
    6 => 'globe',
);
?>

<section class="features section-divider-top section-divider-bottom" id="how-it-works">
    <div class="container">
        <h2><?php cc_e( 'features_main_title', 'Mengapa Memilih Kami?' ); ?></h2>

        <?php
        $feat_defaults = array(
            array( 'Profesional', 'Naskah anda akan ditangani langsung oleh tim ahli layout naskah, desain sampul dan admin marketing yang berkompeten. Bahkan anda bisa terhubung dengan Owner Penerbit buku KBM Indonesia.' ),
            array( 'Harga Murah', 'Anda dapat membuktikan dan melakukan riset ke tempat lain, untuk cetakan 25 eksemplar ke atas, maka biaya di Penerbit buku KBM Indonesia sangat terjangkau dan lebih murah.' ),
            array( 'Proses Cepat', 'Penerbit buku KBM Indonesia selalu berusaha menyesuaikan waktu anda. Dengan jumlah minimal cetak 100 eksemplar, anda bisa melakukan request waktu selesai cetak.' ),
            array( 'Free Ongkir', 'Penerbit buku KBM Indonesia akan memberikan Gratis ongkos kirim ke seluruh wilayah Indonesia, dari Aceh sampai Papua. Bahkan ada layanan kirim buku melalui ekspedisi Travel.' ),
            array( 'Proses Bergaransi', 'Penerbit buku KBM Indonesia akan memberikan GARANSI cetak ulang tanpa tambahan biaya cetak dan ongkos kirim apabila terjadi cacat 100% pada buku yang kami kirim.' ),
            array( 'Distribusi Luas', 'Buku yang kamu terbitkan di Penerbit buku KBM Indonesia akan dibantu jualkan ke berbagai marketplace nasional milik penerbit buku KBM Indonesia.' ),
        );

        $scroll_class = cc_get( 'mobile_scroll_features', true ) ? 'has-horizontal-scroll' : ''; 
        $features_count = intval( cc_get( 'features_count', 3 ) );
        ?>
        <div class="features-grid <?php echo esc_attr( $scroll_class ); ?>">
            <?php for ( $i = 1; $i <= $features_count; $i++ ) :
                $idx   = $i - 1;
                $title = cc_get( "feat_title_{$i}", $feat_defaults[ $idx ][0] );
                $desc  = cc_get( "feat_desc_{$i}", $feat_defaults[ $idx ][1] );
                
                // Ambil setelan ikon dinamis dengan fallback
                $icon_key = cc_get( "feat_icon_{$i}", $icon_defaults[ $i ] );
                $icon     = isset( $icon_library[ $icon_key ] ) ? $icon_library[ $icon_key ] : '';
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
