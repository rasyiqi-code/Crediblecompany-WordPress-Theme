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

// Pastikan faqs bernilai array (termasuk kalau kosong)
if ( ! is_array( $faqs ) ) {
    $faqs = array();
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
