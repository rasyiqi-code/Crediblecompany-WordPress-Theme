<?php
/**
 * Customizer: FAQ Section
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_faq_section', array(
        'title' => __( 'FAQ', 'crediblecompany' ),
        'panel' => 'cc_homepage_panel',
    ) );

    // Custom Control Class untuk Repeater JSON
    if ( class_exists( 'WP_Customize_Control' ) ) {
        class CC_FAQ_Repeater_Control extends WP_Customize_Control {
            public $type = 'cc_faq_repeater';

            public function render_content() {
                ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                    <?php if ( ! empty( $this->description ) ) : ?>
                        <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                    <?php endif; ?>
                </label>

                <div class="cc-faq-repeater-wrapper">
                    <!-- Textarea disembunyikan untuk menampung data JSON yg akan disimpan WP -->
                    <textarea class="cc-faq-data-hidden" style="display:none;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>

                    <div class="cc-faq-items"></div>
                    
                    <button type="button" class="button cc-faq-add-btn" style="margin-top:10px;">+ Tambah FAQ</button>
                </div>

                <style>
                    .cc-faq-item { background:#fff; border:1px solid #ccc; padding:10px; margin-bottom:10px; }
                    .cc-faq-item input, .cc-faq-item textarea { width:100%; margin-bottom:8px; }
                    .cc-faq-remove-btn { color:#d63638; cursor:pointer; font-size:12px; font-weight:bold; }
                </style>

                <script>
                    jQuery(document).ready(function($) {
                        var wrapper = $('.cc-faq-repeater-wrapper');
                        var hiddenInput = wrapper.find('.cc-faq-data-hidden');
                        var itemsContainer = wrapper.find('.cc-faq-items');
                        var addBtn = wrapper.find('.cc-faq-add-btn');

                        // Data Awal
                        var data = [];
                        try {
                            if(hiddenInput.val()) {
                                data = JSON.parse(hiddenInput.val());
                            }
                        } catch(e) {}

                        // Fungsi Render 1 Item
                        function renderItem(q, a) {
                            var html = '<div class="cc-faq-item">';
                            html += '<input type="text" class="faq-q" placeholder="Pertanyaan" value="' + (q ? q.replace(/"/g, '&quot;') : '') + '">';
                            html += '<textarea class="faq-a" placeholder="Jawaban" rows="3">' + (a || '') + '</textarea>';
                            html += '<span class="cc-faq-remove-btn">Remove</span>';
                            html += '</div>';
                            itemsContainer.append(html);
                        }

                        // Render Semua Data Awal
                        if(data.length > 0) {
                            $.each(data, function(index, item) {
                                renderItem(item.q, item.a);
                            });
                        } else {
                            renderItem('', ''); // Beri 1 kosong sebagai default
                        }

                        // Fungsi Sync ke Hidden Input dan Trigger Customizer Change
                        function syncData() {
                            var newData = [];
                            itemsContainer.find('.cc-faq-item').each(function() {
                                var q = $(this).find('.faq-q').val();
                                var a = $(this).find('.faq-a').val();
                                if(q !== '' || a !== '') {
                                    newData.push({ q: q, a: a });
                                }
                            });
                            hiddenInput.val(JSON.stringify(newData)).trigger('change');
                        }

                        // Event Listeners (Tiap ngetik, sync)
                        itemsContainer.on('input', 'input, textarea', function() {
                            syncData();
                        });

                        itemsContainer.on('click', '.cc-faq-remove-btn', function() {
                            $(this).closest('.cc-faq-item').remove();
                            syncData();
                        });

                        addBtn.on('click', function() {
                            renderItem('', '');
                        });
                    });
                </script>
                <?php
            }
        }
    }

    // Default FAQ data in JSON
    $faq_defaults_json = json_encode(array(
        array( 'q' => 'Berapa lama estimasi proses penerbitan?', 'a' => 'Proses penerbitan umumnya memakan waktu 4-8 minggu, tergantung paket yang dipilih dan kompleksitas naskah.' ),
        array( 'q' => 'Apakah penulis mendapatkan royalti dari penjualan?', 'a' => 'Ya, penulis mendapatkan royalti sesuai kesepakatan di kontrak. Persentase bervariasi pada setiap paket.' ),
        array( 'q' => 'Bagaimana cara mendaftarkan naskah penerbitan?', 'a' => 'Anda bisa menghubungi admin kami melalui WhatsApp atau mengisi formulir pendaftaran di website.' ),
    ));

    $wp_customize->add_setting( 'cc_faq_repeater_data', array(
        'default'           => $faq_defaults_json,
        'sanitize_callback' => 'wp_kses_post', // JSON string basically tapi allow raw chars unless script
    ) );

    $wp_customize->add_control( new CC_FAQ_Repeater_Control( $wp_customize, 'cc_faq_repeater_data', array(
        'label'       => __( 'Daftar Pertanyaan & Jawaban', 'crediblecompany' ),
        'description' => __( 'Klik Tambah FAQ untuk menambah kolom, biarkan kosong atau klik Remove untuk menghapus.', 'crediblecompany' ),
        'section'     => 'cc_faq_section',
    ) ) );

} );
