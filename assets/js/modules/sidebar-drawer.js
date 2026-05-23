/**
 * Modul: Sidebar Drawer (Mobile)
 * Menangani buka/tutup sidebar drawer di halaman single testimoni.
 *
 * @package CredibleCompany
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        const sideDrawer = document.getElementById('mobileDrawer');
        const sideToggle = document.getElementById('sidebarToggle');
        const sideClose = document.getElementById('closeDrawer');
        const sideBackdrop = document.getElementById('drawerBackdrop');

        /**
         * Toggle buka/tutup sidebar drawer
         */
        function toggleSideDrawer() {
            if (!sideDrawer) return;
            const isActive = sideDrawer.classList.contains('active');

            if (isActive) {
                sideDrawer.classList.remove('active');
                if (sideBackdrop) sideBackdrop.classList.remove('active');
                document.body.style.overflow = '';
            } else {
                sideDrawer.classList.add('active');
                if (sideBackdrop) sideBackdrop.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        // Event listeners
        if (sideToggle) sideToggle.addEventListener('click', toggleSideDrawer);
        if (sideClose) sideClose.addEventListener('click', toggleSideDrawer);
        if (sideBackdrop) sideBackdrop.addEventListener('click', toggleSideDrawer);
    });
})();
