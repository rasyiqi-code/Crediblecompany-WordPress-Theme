/**
 * Modul: Native Share / Copy Link
 * Menggunakan Web Share API jika tersedia, fallback ke salin link ke clipboard.
 * Menampilkan toast notifikasi saat link berhasil disalin.
 *
 * @package CredibleCompany
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        // Cari semua tombol share di halaman
        var shareBtns = document.querySelectorAll('.app-share-btn');

        shareBtns.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();

                var title = btn.getAttribute('data-share-title') || document.title;
                var url = btn.getAttribute('data-share-url') || window.location.href;

                // Cek: Web Share API tersedia?
                if (navigator.share) {
                    navigator.share({
                        title: title,
                        url: url
                    }).catch(function () {
                        // User membatalkan share, abaikan error
                    });
                } else {
                    // Fallback: salin link ke clipboard
                    copyToClipboard(url);
                }
            });
        });

        /**
         * Salin teks ke clipboard dan tampilkan toast.
         * Menggunakan Clipboard API modern, fallback ke execCommand.
         *
         * @param {string} text - Teks yang akan disalin.
         */
        function copyToClipboard(text) {
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text).then(function () {
                    showToast('Link berhasil disalin!');
                }).catch(function () {
                    fallbackCopy(text);
                });
            } else {
                fallbackCopy(text);
            }
        }

        /**
         * Fallback copy menggunakan textarea tersembunyi + execCommand.
         *
         * @param {string} text - Teks yang akan disalin.
         */
        function fallbackCopy(text) {
            var textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.select();

            try {
                document.execCommand('copy');
                showToast('Link berhasil disalin!');
            } catch (err) {
                showToast('Gagal menyalin link');
            }

            document.body.removeChild(textarea);
        }

        /**
         * Tampilkan toast notifikasi di bagian bawah layar.
         *
         * @param {string} message - Pesan yang ditampilkan.
         */
        function showToast(message) {
            // Hapus toast sebelumnya jika ada
            var existing = document.querySelector('.share-toast');
            if (existing) existing.remove();

            var toast = document.createElement('div');
            toast.className = 'share-toast';
            toast.textContent = message;
            document.body.appendChild(toast);

            // Auto-remove setelah 2.5 detik
            setTimeout(function () {
                toast.classList.add('fade-out');
                setTimeout(function () {
                    if (toast.parentNode) toast.remove();
                }, 300);
            }, 2500);
        }
    });
})();
