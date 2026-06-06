<?php
/**
 * Customizer: FAQ Section
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_faq_section', array(
        'title'    => __( 'FAQ', 'crediblecompany' ),
        'panel'    => 'cc_homepage_panel',
        'priority' => 60,
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
        array( 'q' => 'Lorem ipsum dolor sit amet?', 'a' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam.' ),
        array( 'q' => 'Consectetur adipiscing elit?', 'a' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam.' ),
        array( 'q' => 'Proin sodales imperdiet diam?', 'a' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam.' ),
    ));

    $wp_customize->add_setting( 'cc_faq_repeater_data', array(
        'default'           => $faq_defaults_json,
        'sanitize_callback' => 'cc_sanitize_faq_json',
    ) );

    $wp_customize->add_control( new CC_FAQ_Repeater_Control( $wp_customize, 'cc_faq_repeater_data', array(
        'label'       => __( 'Daftar Pertanyaan & Jawaban', 'crediblecompany' ),
        'description' => __( 'Klik Tambah FAQ untuk menambah kolom, biarkan kosong atau klik Remove untuk menghapus.', 'crediblecompany' ),
        'section'     => 'cc_faq_section',
    ) ) );

    // Pengaturan Warna Section FAQ
    $wp_customize->add_setting( 'cc_faq_bg_color', array(
        'default'           => '#c01314',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_faq_bg_color', array(
        'label'   => __( 'Warna Latar Belakang Section', 'crediblecompany' ),
        'section' => 'cc_faq_section',
    ) ) );

    $wp_customize->add_setting( 'cc_faq_question_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_faq_question_color', array(
        'label'   => __( 'Warna Font Pertanyaan', 'crediblecompany' ),
        'section' => 'cc_faq_section',
    ) ) );

    $wp_customize->add_setting( 'cc_faq_answer_color', array(
        'default'           => '#f3f4f6',
        'sanitize_callback' => 'sanitize_hex_color',
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_faq_answer_color', array(
        'label'   => __( 'Warna Font Jawaban', 'crediblecompany' ),
        'section' => 'cc_faq_section',
    ) ) );

} );

