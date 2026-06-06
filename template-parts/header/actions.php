<?php
/**
 * Template Part: Header Action Buttons (Tombol Cari & Akun).
 * Komentar di kode menggunakan bahasa Indonesia.
 *
 * @package CredibleCompany
 */

$search_url  = cc_get( 'header_search_url', '' );
$account_url = cc_get( 'header_account_url', '' );
?>
<div class="header-icons">
    <!-- Tombol Pencarian -->
    <?php if ( ! empty( $search_url ) ) : ?>
        <!-- Jika URL pencarian kustom diisi di customizer, arahkan ke tautan langsung -->
        <a href="<?php echo esc_url( $search_url ); ?>" aria-label="Cari" class="header-icon-link" style="color: inherit; text-decoration: none; padding: 0.5rem; display: flex; align-items: center; justify-content: center;">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </a>
    <?php else : ?>
        <!-- Jika kosong, tampilkan toggle overlay pencarian (AJAX/JS-based) -->
        <button type="button" aria-label="Cari" id="header-search-toggle">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </button>
    <?php endif; ?>

    <!-- Tombol Akun / Profil -->
    <?php if ( ! empty( $account_url ) ) : ?>
        <a href="<?php echo esc_url( $account_url ); ?>" aria-label="Akun" class="header-icon-link" style="color: inherit; text-decoration: none; padding: 0.5rem; display: flex; align-items: center; justify-content: center;">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </a>
    <?php endif; ?>
</div>
