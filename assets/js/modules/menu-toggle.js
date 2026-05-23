/**
 * Modul: Mobile Menu Toggle
 * Menangani buka/tutup navigasi hamburger di mobile.
 * Mengontrol desktop-nav (drawer) dan primary-nav (horizontal scroll).
 *
 * @package CredibleCompany
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        const menuToggle = document.querySelector('.menu-toggle');
        const desktopNav = document.querySelector('.desktop-nav');
        const primaryNav = document.querySelector('.primary-nav');

        if (menuToggle) {
            menuToggle.addEventListener('click', function () {
                // Toggle desktop-nav drawer di mobile
                if (desktopNav) {
                    desktopNav.classList.toggle('active');
                }

                // Toggle primary-nav (untuk halaman non-homepage)
                if (primaryNav) {
                    primaryNav.classList.toggle('active');
                }

                // Toggle ikon hamburger / close
                const isOpen = (desktopNav && desktopNav.classList.contains('active')) ||
                    (primaryNav && primaryNav.classList.contains('active'));
                menuToggle.setAttribute('aria-expanded', isOpen);
                menuToggle.innerHTML = isOpen ? '&#x2715;' : '&#9776;';
            });
        }
    });
})();
