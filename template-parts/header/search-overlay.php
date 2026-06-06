<?php
/**
 * Template Part: Header Search Overlay.
 * Berisi form pencarian tersembunyi yang muncul saat tombol cari di-klik.
 * Komentar di kode menggunakan bahasa Indonesia.
 *
 * @package CredibleCompany
 */
?>
<!-- Form Pencarian Overlay (Dropdown) -->
<div id="header-search-overlay" class="header-search-overlay" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: var(--bg-body, #ffffff); padding: 10px 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); z-index: 1000; border-top: 1px solid var(--border-color, #eee);">
    <?php get_search_form(); ?>
</div>

<script>
    // Inisialisasi event listener interaksi buka-tutup pencarian
    document.addEventListener('DOMContentLoaded', function() {
        var searchToggle  = document.getElementById('header-search-toggle');
        var searchOverlay = document.getElementById('header-search-overlay');
        var searchInput   = searchOverlay ? searchOverlay.querySelector('input[type="search"]') : null;

        if (searchToggle && searchOverlay) {
            // Toggle form pencarian saat tombol cari di-klik
            searchToggle.addEventListener('click', function(e) {
                e.preventDefault();
                if (searchOverlay.style.display === 'none') {
                    searchOverlay.style.display = 'block';
                    if (searchInput) searchInput.focus();
                } else {
                    searchOverlay.style.display = 'none';
                }
            });

            // Tutup overlay jika pengguna mengklik di luar area form pencarian
            document.addEventListener('click', function(event) {
                var isClickInside = searchToggle.contains(event.target) || searchOverlay.contains(event.target);
                if (!isClickInside && searchOverlay.style.display === 'block') {
                    searchOverlay.style.display = 'none';
                }
            });
        }
    });
</script>
