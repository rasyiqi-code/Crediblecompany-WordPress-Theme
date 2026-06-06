<?php
/**
 * Customizer: Hero Section
 *
 * @package CredibleCompany
 */

add_action( 'customize_register', function( $wp_customize ) {

    $wp_customize->add_section( 'cc_hero_section', array(
        'title'    => __( 'Hero Section', 'crediblecompany' ),
        'panel'    => 'cc_homepage_panel',
        'priority' => 10,
    ) );

    // --- PILIHAN LAYOUT / VARIANT HERO ---
    $wp_customize->add_setting( 'cc_hero_variant', array(
        'default'           => 'default',
        'sanitize_callback' => 'sanitize_key',
    ) );
    $wp_customize->add_control( 'cc_hero_variant', array(
        'label'       => __( 'Layout Hero', 'crediblecompany' ),
        'description' => __( 'Pilih tampilan hero yang digunakan di halaman depan.', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'select',
        'choices'     => array(
            'default' => 'Default — Teks kiri, gambar kanan dengan shapes',
            'v2'      => 'Centered — Teks tengah, gradient latar, tanpa gambar',
            'v3'      => 'Jasper — Centered, promo badge, & grid grafis melayang',
        ),
        'priority'    => 1, // Paling atas
    ) );

    // --- PROMO BADGE HERO (KHUSUS LAYOUT JASPER V3) ---
    $wp_customize->add_setting( 'cc_hero_promo_text', array(
        'default'           => 'New! Introducing the new Jasper: Canvas, Agents, and a bold rebrand.',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_promo_text', array(
        'label'       => __( 'Teks Promo Badge Hero', 'crediblecompany' ),
        'description' => __( 'Teks pengumuman di atas judul hero (hanya aktif pada layout Jasper).', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
        'priority'    => 2,
    ) );

    $wp_customize->add_setting( 'cc_hero_promo_url', array(
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( 'cc_hero_promo_url', array(
        'label'       => __( 'URL Promo Badge Hero', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'url',
        'priority'    => 3,
    ) );

    // Judul Hero
    $wp_customize->add_setting( 'cc_hero_title', array(
        'default'           => 'Lorem Ipsum Dolor Sit Amet',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'cc_hero_title', array(
        'label'   => __( 'Judul Hero', 'crediblecompany' ),
        'section' => 'cc_hero_section',
        'type'    => 'text',
    ) );

    // Deskripsi Hero
    $wp_customize->add_setting( 'cc_hero_desc', array(
        'default'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sodales imperdiet diam, nec imperdiet elit tempor ut. Duis lobortis scelerisque nisi.',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'postMessage',
    ) );
    $wp_customize->add_control( 'cc_hero_desc', array(
        'label'   => __( 'Deskripsi Hero', 'crediblecompany' ),
        'section' => 'cc_hero_section',
        'type'    => 'textarea',
    ) );

    // --- TOMBOL 1 (KIRI / UTAMA) ---
    $wp_customize->add_setting( 'cc_hero_btn1_enable', array( 'default' => true, 'sanitize_callback' => 'wp_validate_boolean' ) );
    $wp_customize->add_control( 'cc_hero_btn1_enable', array( 'label' => __( 'Tampilkan Tombol Utama', 'crediblecompany' ), 'section' => 'cc_hero_section', 'type' => 'checkbox' ) );

    $wp_customize->add_setting( 'cc_hero_btn1_text', array( 'default' => 'Start Trial', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'cc_hero_btn1_text', array( 'label' => __( 'Teks Tombol Utama', 'crediblecompany' ), 'section' => 'cc_hero_section', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cc_hero_btn1_url', array( 'default' => '#daftar', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'cc_hero_btn1_url', array(
        'label'       => __( 'URL Tombol Utama', 'crediblecompany' ),
        'description' => __( 'Gunakan ID section untuk smooth scroll: #hero, #how-it-works, #daftar-paket, #books, #testimonials, #blog, #faq, #mitra', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'url',
    ) );

    // Warna Latar & Teks Tombol Utama
    $wp_customize->add_setting( 'cc_hero_btn1_bg_color', array( 'default' => '#1d4ed8', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_btn1_bg_color', array( 'label' => 'Warna Latar Tombol Utama', 'section' => 'cc_hero_section' ) ) );
    
    $wp_customize->add_setting( 'cc_hero_btn1_text_color', array( 'default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_btn1_text_color', array( 'label' => 'Warna Teks Tombol Utama', 'section' => 'cc_hero_section' ) ) );

    // --- TOMBOL 2 (KANAN / OUTLINE) ---
    $wp_customize->add_setting( 'cc_hero_btn2_enable', array( 'default' => true, 'sanitize_callback' => 'wp_validate_boolean' ) );
    $wp_customize->add_control( 'cc_hero_btn2_enable', array( 'label' => __( 'Tampilkan Tombol Sekunder', 'crediblecompany' ), 'section' => 'cc_hero_section', 'type' => 'checkbox' ) );

    $wp_customize->add_setting( 'cc_hero_btn2_text', array( 'default' => 'How It Works', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'cc_hero_btn2_text', array( 'label' => __( 'Teks Tombol Sekunder', 'crediblecompany' ), 'section' => 'cc_hero_section', 'type' => 'text' ) );

    $wp_customize->add_setting( 'cc_hero_btn2_url', array( 'default' => '#how-it-works', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'cc_hero_btn2_url', array(
        'label'       => __( 'URL Tombol Sekunder', 'crediblecompany' ),
        'description' => __( 'Gunakan ID section untuk smooth scroll (lihat daftar ID di tombol utama).', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'url',
    ) );
    
    // Warna Latar & Teks Tombol Sekunder
    $wp_customize->add_setting( 'cc_hero_btn2_bg_color', array( 'default' => 'transparent', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_btn2_bg_color', array( 'label' => 'Warna Latar Tombol Sekunder', 'section' => 'cc_hero_section' ) ) );
    
    $wp_customize->add_setting( 'cc_hero_btn2_text_color', array( 'default' => '#1d4ed8', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new \WP_Customize_Color_Control( $wp_customize, 'cc_hero_btn2_text_color', array( 'label' => 'Warna Teks Tombol Sekunder', 'section' => 'cc_hero_section' ) ) );

    // --- STYLE TOMBOL GLOBAL (BENTUK / SHAPE) ---
    $wp_customize->add_setting( 'cc_hero_btn_shape', array(
        'default'           => '50px', // pill shape default
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_btn_shape', array(
        'label'   => __( 'Bentuk Pola Border Tombol', 'crediblecompany' ),
        'section' => 'cc_hero_section',
        'type'    => 'select',
        'choices' => array(
            '50px'    => 'Bulat Melengkung (Pill)',
            '8px'     => 'Sudut Tumpul (Rounded)',
            '0px'     => 'Kotak Persegi (Square)',
        )
    ) );

    // Gambar Hero
    $wp_customize->add_setting( 'cc_hero_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cc_hero_image', array(
        'label'   => __( 'Gambar Hero', 'crediblecompany' ),
        'section' => 'cc_hero_section',
    ) ) );

    // Ornamen Melayang 1
    $wp_customize->add_setting( 'cc_hero_ornament_1', array(
        'default'           => '📚', // Default buku
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_ornament_1', array(
        'label'       => __( 'Ornamen Melayang 1 (Emoji/Teks)', 'crediblecompany' ),
        'description' => __( 'Tampil di kiri atas gambar hero. Gunakan emoji (misal: 📚, 🚀, 💡).', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );
 
    // Ornamen Melayang 2
    $wp_customize->add_setting( 'cc_hero_ornament_2', array(
        'default'           => '🎓', // Default Toga
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_ornament_2', array(
        'label'       => __( 'Ornamen Melayang 2 (Emoji/Teks)', 'crediblecompany' ),
        'description' => __( 'Tampil di kanan bawah gambar hero.', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    // Ornamen Melayang 3 (Aksen Tambahan V2)
    $wp_customize->add_setting( 'cc_hero_ornament_3', array(
        'default'           => '✨',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_ornament_3', array(
        'label'       => __( 'Ornamen Melayang 3 (Emoji/Teks)', 'crediblecompany' ),
        'description' => __( 'Tampil di kanan atas layout Centered (V2).', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    // --- PENGATURAN SPESIFIK LAYOUT CENTRED (V2) ---
    $wp_customize->add_setting( 'cc_hero_v2_badge_text', array(
        'default'           => 'Solusi Terpercaya & Modern',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_v2_badge_text', array(
        'label'       => __( 'Teks Badge Hero V2', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    // --- PENGATURAN SPESIFIK LAYOUT JASPER (V3) ---
    $wp_customize->add_setting( 'cc_hero_promo_tag', array(
        'default'           => 'New!',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_promo_tag', array(
        'label'       => __( 'Label Promo Badge Hero V3', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'cc_hero_v3_card_left_icon', array(
        'default'           => '🔴',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_v3_card_left_icon', array(
        'label'       => __( 'Emoji Kartu Melayang Kiri V3', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'cc_hero_v3_card_left_text', array(
        'default'           => 'Buat 6.000 email super-personal dalam hitungan menit',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_v3_card_left_text', array(
        'label'       => __( 'Teks Kartu Melayang Kiri V3', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'cc_hero_v3_card_right_num', array(
        'default'           => '11x',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_v3_card_right_num', array(
        'label'       => __( 'Angka Kartu Melayang Kanan V3', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'cc_hero_v3_card_right_text', array(
        'default'           => 'rasio klik-tayang',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_v3_card_right_text', array(
        'label'       => __( 'Label Kartu Melayang Kanan V3', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'cc_hero_v3_partners_title', array(
        'default'           => 'Dipercaya oleh tim pemasaran kelas dunia',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cc_hero_v3_partners_title', array(
        'label'       => __( 'Judul Logo Kredibilitas Mitra V3', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    /* ---- WARNA SHAPES HERO ---- */
    // Gambar Background Shape (Lingkaran Utama)
    $wp_customize->add_setting( 'cc_hero_shape_bg_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cc_hero_shape_bg_image', array(
        'label'       => __( 'Gambar Latar Shape Utama (SVG/PNG/WEBP)', 'crediblecompany' ),
        'description' => __( 'Upload gambar latar abstrak jika tidak ingin lingkaran polos. Kosongkan untuk pakai warna solid.', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
    ) ) );

    // Warna Background Utama
    $wp_customize->add_setting( 'cc_hero_shape_main_color', array( 'default' => '#ea580c', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_hero_shape_main_color', array( 'label' => 'Warna Latar Lingkaran Utama', 'section' => 'cc_hero_section' ) ) );

    // Warna Blob Kuning
    $wp_customize->add_setting( 'cc_hero_shape_yellow_color', array( 'default' => '#EAB308', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_hero_shape_yellow_color', array( 'label' => 'Warna Background Shape 1', 'section' => 'cc_hero_section' ) ) );

    // Warna Lingkaran Biru
    $wp_customize->add_setting( 'cc_hero_shape_blue_color', array( 'default' => '#3B82F6', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_hero_shape_blue_color', array( 'label' => 'Warna Background Shape 2', 'section' => 'cc_hero_section' ) ) );

    // Warna Lingkaran Merah
    $wp_customize->add_setting( 'cc_hero_shape_red_color', array( 'default' => '#EF4444', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_hero_shape_red_color', array( 'label' => 'Warna Background Shape 3', 'section' => 'cc_hero_section' ) ) );

    // Warna Lingkaran Ungu
    $wp_customize->add_setting( 'cc_hero_shape_purple_color', array( 'default' => '#8B5CF6', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cc_hero_shape_purple_color', array( 'label' => 'Warna Background Shape 4', 'section' => 'cc_hero_section' ) ) );

    // --- PENGATURAN SPACING & TATA LETAK ---
    $wp_customize->add_setting( 'cc_hero_padding_top', array( 'default' => '6rem', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'cc_hero_padding_top', array(
        'label'       => __( 'Padding Atas Hero', 'crediblecompany' ),
        'description' => __( 'Jarak ruang atas section Hero (contoh: 6rem, 100px).', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'cc_hero_padding_bottom', array( 'default' => '4rem', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'cc_hero_padding_bottom', array(
        'label'       => __( 'Padding Bawah Hero', 'crediblecompany' ),
        'description' => __( 'Jarak ruang bawah section Hero (contoh: 4rem, 80px).', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'cc_hero_title_margin_bottom', array( 'default' => '1.5rem', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'cc_hero_title_margin_bottom', array(
        'label'       => __( 'Margin Bawah Judul', 'crediblecompany' ),
        'description' => __( 'Jarak dari judul ke deskripsi di bawahnya (contoh: 1.5rem, 20px).', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    // --- PENGATURAN TIPOGRAFI (FONT) ---
    $wp_customize->add_setting( 'cc_hero_title_size', array( 'default' => '3.5rem', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'cc_hero_title_size', array(
        'label'       => __( 'Ukuran Font Judul Hero', 'crediblecompany' ),
        'description' => __( 'Ukuran teks untuk judul utama Hero (contoh: 3.5rem, 48px).', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'cc_hero_title_weight', array( 'default' => '900', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'cc_hero_title_weight', array(
        'label'   => __( 'Ketebalan Font Judul Hero', 'crediblecompany' ),
        'section' => 'cc_hero_section',
        'type'    => 'select',
        'choices' => array(
            '400' => 'Normal (400)',
            '600' => 'Semi-Bold (600)',
            '700' => 'Bold (700)',
            '800' => 'Extra-Bold (800)',
            '900' => 'Black (900)',
        )
    ) );

    $wp_customize->add_setting( 'cc_hero_desc_size', array( 'default' => '1.125rem', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'cc_hero_desc_size', array(
        'label'       => __( 'Ukuran Font Deskripsi Hero', 'crediblecompany' ),
        'description' => __( 'Ukuran teks untuk deskripsi di bawah judul (contoh: 1.125rem, 18px).', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    // --- PENGATURAN KELENGKUNGAN SUDUT (ROUND) ---
    $wp_customize->add_setting( 'cc_hero_card_radius', array( 'default' => '16px', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'cc_hero_card_radius', array(
        'label'       => __( 'Kelengkungan Kartu Melayang', 'crediblecompany' ),
        'description' => __( 'Radius sudut untuk kartu-kartu melayang di Hero (contoh: 16px, 8px, 0px).', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'cc_hero_canvas_radius', array( 'default' => '24px', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'cc_hero_canvas_radius', array(
        'label'       => __( 'Kelengkungan Canvas Grafis V3', 'crediblecompany' ),
        'description' => __( 'Radius sudut atas untuk grid canvas hijau pada layout Jasper (contoh: 24px, 12px, 0px).', 'crediblecompany' ),
        'section'     => 'cc_hero_section',
        'type'        => 'text',
    ) );

} );

/**
 * Suntikkan Variabel CSS Dinamis ke Header berdasarkan pengaturan Customizer.
 */
add_action( 'wp_head', 'cc_hero_dynamic_css_variables', 100 );
function cc_hero_dynamic_css_variables() {
    $padding_top    = cc_get( 'hero_padding_top', '6rem' );
    $padding_bottom = cc_get( 'hero_padding_bottom', '4rem' );
    $title_size     = cc_get( 'hero_title_size', '3.5rem' );
    $title_weight   = cc_get( 'hero_title_weight', '900' );
    $title_margin   = cc_get( 'hero_title_margin_bottom', '1.5rem' );
    $desc_size      = cc_get( 'hero_desc_size', '1.125rem' );
    $card_radius    = cc_get( 'hero_card_radius', '16px' );
    $canvas_radius  = cc_get( 'hero_canvas_radius', '24px' );
    ?>
    <style type="text/css" id="cc-hero-dynamic-variables">
        :root {
            --cc-hero-padding-top: <?php echo esc_attr( $padding_top ); ?>;
            --cc-hero-padding-bottom: <?php echo esc_attr( $padding_bottom ); ?>;
            --cc-hero-title-size: <?php echo esc_attr( $title_size ); ?>;
            --cc-hero-title-weight: <?php echo esc_attr( $title_weight ); ?>;
            --cc-hero-title-margin-bottom: <?php echo esc_attr( $title_margin ); ?>;
            --cc-hero-desc-size: <?php echo esc_attr( $desc_size ); ?>;
            --cc-hero-card-radius: <?php echo esc_attr( $card_radius ); ?>;
            --cc-hero-canvas-radius: <?php echo esc_attr( $canvas_radius ); ?>;
        }
    </style>
    <?php
}
