/**
 * Modul: TOC Drawer & Scrollspy
 * Menangani mobile drawer Table of Contents dan scrollspy heading aktif.
 *
 * @package CredibleCompany
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        const tocDrawer = document.getElementById('toc-drawer');
        const openTocBtn = document.getElementById('open-toc-btn');
        const closeTocBtn = document.getElementById('close-toc-btn');
        const tocOverlay = document.getElementById('toc-overlay');
        const tocLinks = document.querySelectorAll('.toc-link');

        /**
         * Toggle buka/tutup drawer TOC
         */
        function toggleDrawer() {
            if (!tocDrawer) return;
            const isActive = tocDrawer.classList.contains('active');

            if (isActive) {
                tocDrawer.classList.remove('active');
                if (tocOverlay) tocOverlay.classList.remove('active');
                document.body.style.overflow = ''; // Restore scroll
            } else {
                tocDrawer.classList.add('active');
                if (tocOverlay) tocOverlay.classList.add('active');
                document.body.style.overflow = 'hidden'; // Prevent background scroll
            }
        }

        // Event listeners drawer
        if (openTocBtn) openTocBtn.addEventListener('click', toggleDrawer);
        if (closeTocBtn) closeTocBtn.addEventListener('click', toggleDrawer);
        if (tocOverlay) tocOverlay.addEventListener('click', toggleDrawer);

        // Tutup drawer saat link diklik + smooth scroll
        tocLinks.forEach(function (link) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const targetId = this.getAttribute('href').substring(1);
                const targetElement = document.getElementById(targetId);

                if (targetElement) {
                    // Offset untuk fixed header
                    const offsetTop = targetElement.getBoundingClientRect().top + window.scrollY - 80;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }

                // Tutup drawer di mobile
                if (window.innerWidth < 1024 && tocDrawer && tocDrawer.classList.contains('active')) {
                    toggleDrawer();
                }
            });
        });

        // Scrollspy: highlight item TOC yang sedang terlihat
        if (tocLinks.length > 0) {
            const sections = Array.from(
                document.querySelectorAll('.app-article-body h2, .app-article-body h3')
            );

            window.addEventListener('scroll', function () {
                let current = '';
                const scrollPos = window.scrollY + 150; // Toleransi offset

                sections.forEach(function (section) {
                    const sectionTop = section.offsetTop;
                    if (scrollPos >= sectionTop) {
                        current = section.getAttribute('id');
                    }
                });

                tocLinks.forEach(function (link) {
                    link.classList.remove('active');
                    if (link.getAttribute('href').includes(current) && current !== '') {
                        link.classList.add('active');
                    }
                });
            });
        }
    });
})();
