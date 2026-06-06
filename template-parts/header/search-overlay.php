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
    // Inisialisasi event listener interaksi buka-tutup pencarian dengan aman
    document.addEventListener('DOMContentLoaded', function() {
        var searchToggle  = document.getElementById('header-search-toggle');
        var searchOverlay = document.getElementById('header-search-overlay');
        
        if (searchToggle && searchOverlay) {
            var searchInput = searchOverlay.querySelector('input[type="search"]');

            // Fungsi untuk menampilkan/menyembunyikan form pencarian
            function toggleSearch(e) {
                e.preventDefault();
                e.stopPropagation(); // Mencegah event merambat ke document click listener
                
                // Cek status tampilan computed yang sebenarnya secara akurat
                var isHidden = window.getComputedStyle(searchOverlay).display === 'none';
                
                if (isHidden) {
                    searchOverlay.style.setProperty('display', 'block', 'important');
                    if (searchInput) {
                        setTimeout(function() {
                            searchInput.focus();
                        }, 50); // Delay kecil agar transpirasi transisi CSS selesai fokus
                    }
                } else {
                    searchOverlay.style.setProperty('display', 'none', 'important');
                }
            }

            searchToggle.addEventListener('click', toggleSearch);

            // Tutup overlay pencarian secara otomatis jika mengklik area lain di luar form
            document.addEventListener('click', function(event) {
                var isClickInside = searchToggle.contains(event.target) || searchOverlay.contains(event.target);
                if (!isClickInside) {
                    searchOverlay.style.setProperty('display', 'none', 'important');
                }
            });
            
            // Mencegah klik di dalam form pencarian menutup overlay-nya sendiri
            searchOverlay.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
    });
</script>
