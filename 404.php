<?php
/**
 * Halaman 404 (Tidak Ditemukan)
 * Berdesain App-Mobile First
 *
 * @package CredibleCompany
 */

get_header(); ?>

<main class="app-main-content">
    <div class="app-header-bar">
        <!-- Tombol kembali gaya App -->
        <a href="javascript:history.back()" class="app-back-btn">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <h1 class="app-page-title"><?php esc_html_e( 'Halaman Tidak Ditemukan', 'cc' ); ?></h1>
    </div>

    <div class="app-error-container flex-center-col" style="min-height: 60vh; text-align: center; padding: 2rem;">
        <div class="error-illustration" style="font-size: 5rem; margin-bottom: 1rem;">
            🕵️‍♂️
        </div>
        <h2 class="error-title" style="margin-bottom: 0.5rem; font-size: 1.5rem; color: var(--text-dark);">Oops!</h2>
        <p class="error-message" style="color: var(--text-muted); margin-bottom: 2rem;">
            <?php esc_html_e( 'Halaman yang Anda cari mungkin telah dihapus, namanya diubah, atau sementara tidak tersedia.', 'cc' ); ?>
        </p>

        <div class="error-search-wrap" style="width: 100%; max-width: 400px; margin-bottom: 2rem;">
            <?php get_search_form(); ?>
        </div>

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary app-btn">
            <?php esc_html_e( 'Kembali ke Beranda', 'cc' ); ?>
        </a>
    </div>
</main>

<?php get_footer(); ?>
