<?php
/**
 * Template Part: Header Logo.
 * Komentar di kode menggunakan bahasa Indonesia.
 *
 * @package CredibleCompany
 */
?>
<div class="site-logo">
    <?php if ( has_custom_logo() ) : ?>
        <?php the_custom_logo(); ?>
    <?php else : ?>
        <!-- Fallback teks nama situs jika logo kustom belum diunggah -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php bloginfo( 'name' ); ?>
        </a>
    <?php endif; ?>
</div>
