<?php
/**
 * Template Part: FAQ Section.
 * FAQ ditampilkan dengan accordion (JS di main.js).
 * Data diambil dari Customizer (cc_faq_q_N / cc_faq_a_N).
 *
 * @package CredibleCompany
 */

// SVG ikon
$arrow_svg = '<svg class="faq-arrow" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>';
$check_svg = '<svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';

// Ambil data FAQ dari Customizer (JSON form repeater)
$faq_json = cc_get( 'faq_repeater_data', '' );

// Decode data JSON ke dalam array PHP
$faqs = json_decode( $faq_json, true );

// Pastikan faqs bernilai array dan berikan fallback default jika kosong agar FAQ langsung muncul di homepage
if ( ! is_array( $faqs ) || empty( $faqs ) ) {
    $faqs = array(
        array( 
            'q' => 'Berapa lama estimasi proses penerbitan buku?', 
            'a' => 'Estimasi proses penerbitan berkisar antara 1 hingga 3 minggu, bergantung pada kelengkapan naskah dan antrean pendaftaran ISBN/QRSBN di Perpusnas. Kami juga menyediakan fasilitas kilat khusus untuk pengurusan ISBN dalam 1-2 hari.' 
        ),
        array( 
            'q' => 'Apakah penulis mendapatkan royalti dari penjualan buku melalui penerbit?', 
            'a' => 'Ya, penulis akan mendapatkan royalti penjualan buku sebesar 25%. Laporan penjualan buku akan disampaikan secara transparan melalui email setiap bulannya.' 
        ),
        array( 
            'q' => 'Bagaimana cara mendaftarkan naskah untuk diterbitkan?', 
            'a' => 'Anda cukup memilih paket penerbitan yang sesuai dengan kebutuhan Anda di website kami, kemudian mengirimkan naskah Anda beserta data diri melalui WhatsApp admin atau email resmi kami.' 
        ),
        array( 
            'q' => 'Keuntungan apa saja yang didapat oleh penulis saat menerbitkan buku?', 
            'a' => 'Penulis mendapatkan fasilitas gratis ongkos kirim ke seluruh Indonesia, buku terindeks di Google Scholar dan Google Playbook, laporan royalti bulanan yang transparan, hak cipta buku (HAKI) dari Kemenkumham, serta bantuan pemasaran di marketplace nasional milik KBM Indonesia.' 
        ),
        array( 
            'q' => 'Penerbit buku KBM Indonesia bisa menerbitkan buku apa saja?', 
            'a' => 'Kami menerima berbagai jenis naskah baik fiksi maupun non-fiksi (sastra dan non-sastra), seperti novel, kumpulan puisi, buku ajar/dosen, biografi, opini, hingga buku ilmiah/penelitian.' 
        ),
        array( 
            'q' => 'Apakah semua naskah yang masuk di Penerbit buku KBM Indonesia pasti terbit?', 
            'a' => 'Kami berkomitmen membantu semua penulis untuk menerbitkan karyanya. Naskah Anda pasti terbit selama tidak mengandung unsur SARA, pornografi, plagiasi, atau pelanggaran hukum lainnya.' 
        ),
        array( 
            'q' => 'Apakah setiap naskah yang akan diterbitkan akan diedit oleh penerbit?', 
            'a' => 'Ya, naskah Anda akan melewati proses layout (tata letak) dan desain cover oleh tim ahli kami sesuai dengan ketentuan paket yang Anda pilih agar buku tampil profesional dan siap cetak.' 
        ),
        array( 
            'q' => 'Bagaimana cara mengirim naskah buku ke penerbit?', 
            'a' => 'Sangat gampang, yaitu langsung dikirim naskah buku anda via email ke naskah@penerbitkbm.com atau di kirim melalui nomer whatsapp kantor pusat di 081357517526 dan buku anda akan kami rubah ukurannya sesuai keinginan dan kebutuhan penulis.' 
        ),
    );
}
?>

<?php if ( ! empty( $faqs ) ) : 
    // Prepare Schema Data
    $schema_items = array();
    foreach ( $faqs as $faq ) {
        $schema_items[] = array(
            '@type'          => 'Question',
            'name'           => $faq['q'],
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text'  => $faq['a'],
            ),
        );
    }
    $schema_json = json_encode( array(
        '@context'   => 'https://schema.org',
        '@type'      => 'FAQPage',
        'mainEntity' => $schema_items,
    ) );
?>
<!-- FAQ Schema JSON-LD -->
<script type="application/ld+json"><?php echo $schema_json; ?></script>

<section class="faq" id="faq">
    <div class="container">
        <h2 class="faq-title"><?php echo esc_html( cc_get( 'faq_title', 'Pertanyaan yang Sering Diajukan' ) ); ?></h2>
        <div class="faq-list">
            <?php foreach ( $faqs as $index => $faq ) : 
                $faq_id = 'faq-answer-' . $index;
            ?>
                <div class="faq-item">
                    <button type="button" 
                            class="faq-question" 
                            aria-expanded="false" 
                            aria-controls="<?php echo esc_attr( $faq_id ); ?>">
                        <?php echo $check_svg; ?>
                        <span><?php echo esc_html( $faq['q'] ); ?></span>
                        <?php echo $arrow_svg; ?>
                    </button>
                    <div id="<?php echo esc_attr( $faq_id ); ?>" 
                         class="faq-answer" 
                         role="region" 
                         aria-labelledby="faq-question-<?php echo esc_attr( $index ); ?>">
                        <p><?php echo esc_html( $faq['a'] ); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
