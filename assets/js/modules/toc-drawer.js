/**
 * Modul: TOC Drawer & Scrollspy
 * Menangani mobile drawer Table of Contents dan scrollspy heading aktif.
 * Scrollspy menggunakan IntersectionObserver (lebih efisien daripada scroll event).
 *
 * @package CredibleCompany
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        const tocDrawer  = document.getElementById('toc-drawer');
        const openTocBtn = document.getElementById('open-toc-btn');
        const closeTocBtn = document.getElementById('close-toc-btn');
        const tocOverlay = document.getElementById('toc-overlay');
        const tocLinks   = document.querySelectorAll('.toc-link');

        /**
         * Toggle buka/tutup drawer TOC.
         */
        function toggleDrawer() {
            if (!tocDrawer) return;
            const isActive = tocDrawer.classList.contains('active');

            if (isActive) {
                tocDrawer.classList.remove('active');
                if (tocOverlay) tocOverlay.classList.remove('active');
                document.body.style.overflow = '';
            } else {
                tocDrawer.classList.add('active');
                if (tocOverlay) tocOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        // Event listeners drawer
        if (openTocBtn)  openTocBtn.addEventListener('click', toggleDrawer);
        if (closeTocBtn) closeTocBtn.addEventListener('click', toggleDrawer);
        if (tocOverlay)  tocOverlay.addEventListener('click', toggleDrawer);

        // Tutup drawer saat link diklik + smooth scroll
        tocLinks.forEach(function (link) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId      = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    // Offset untuk fixed header
                    const offsetTop = targetElement.getBoundingClientRect().top + window.scrollY - 80;
                    window.scrollTo({ top: offsetTop, behavior: 'smooth' });
                }

                // Tutup drawer di mobile
                if (window.innerWidth < 1024 && tocDrawer && tocDrawer.classList.contains('active')) {
                    toggleDrawer();
                }
            });
        });

        // Scrollspy: highlight item TOC aktif menggunakan IntersectionObserver
        // Lebih efisien dari scroll event listener — dijalankan off main thread oleh browser.
        if (tocLinks.length > 0) {
            const sections = Array.from(
                document.querySelectorAll('.app-article-body h2, .app-article-body h3')
            );

            if (sections.length > 0 && 'IntersectionObserver' in window) {
                let activeSectionId = '';

                const observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            activeSectionId = entry.target.getAttribute('id');
                        }
                    });

                    // Update state kelas aktif pada link TOC
                    tocLinks.forEach(function (link) {
                        link.classList.remove('active');
                        if (activeSectionId && link.getAttribute('href') === '#' + activeSectionId) {
                            link.classList.add('active');
                        }
                    });
                }, {
                    // Heading dianggap aktif saat memasuki 25% atas viewport
                    rootMargin: '-10% 0px -70% 0px',
                    threshold: 0,
                });

                sections.forEach(function (section) {
                    observer.observe(section);
                });
            }
        }
    });
})();
