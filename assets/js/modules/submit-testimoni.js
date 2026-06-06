/**
 * Modul: Validasi & Submit Form Testimoni
 * Memeriksa ukuran berkas (maks 1MB) dan rasio dimensi gambar secara dinamis.
 * Mengambil nonce CSRF fresh via AJAX sebelum submit (kompatibel dengan halaman cache).
 *
 * @package CredibleCompany
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        const form      = document.querySelector('.cc-submit-form');
        const fileInput = document.getElementById('client_photo');
        const uploadUi  = document.querySelector('.custom-file-upload .upload-ui span');
        const nonceInput = document.getElementById('cc_form_nonce');

        // Ambil ajaxurl dari ccAjax (di-localize oleh enqueue.php)
        const ajaxUrl = (typeof ccAjax !== 'undefined') ? ccAjax.ajaxurl : '/wp-admin/admin-ajax.php';

        /**
         * Reset tampilan input file dan labelnya.
         */
        function resetUploadUI() {
            if (fileInput) fileInput.value = '';
            if (uploadUi) {
                uploadUi.textContent = 'Pilih Gambar';
                uploadUi.parentElement.classList.remove('has-file');
                uploadUi.parentElement.style.borderColor = '';
                uploadUi.parentElement.style.background = '';
            }
        }

        /**
         * Ambil nonce segar dari server via AJAX.
         * Tidak menggunakan nonce yang di-bake ke markup agar halaman boleh di-cache.
         *
         * @returns {Promise<string>} Nonce string.
         */
        function fetchFreshNonce() {
            const data = new FormData();
            data.append('action', 'cc_get_testimoni_nonce');
            return fetch(ajaxUrl, { method: 'POST', body: data })
                .then(function (res) { return res.json(); })
                .then(function (json) {
                    if (json && json.success && json.data && json.data.nonce) {
                        return json.data.nonce;
                    }
                    throw new Error('Gagal mengambil nonce dari server.');
                });
        }

        // Validasi input gambar saat file dipilih
        if (fileInput && uploadUi) {
            fileInput.addEventListener('change', function () {
                if (this.files && this.files.length > 0) {
                    const file = this.files[0];

                    // Cek ukuran berkas (1MB = 1.048.576 bytes)
                    if (file.size > 1048576) {
                        alert('Ukuran file foto melebihi batas maksimum 1MB.');
                        resetUploadUI();
                        return;
                    }

                    // Cek rasio dimensi gambar menggunakan API Image
                    const img = new Image();
                    img.onload = function () {
                        URL.revokeObjectURL(this.src);
                        const ratio = this.width / this.height;
                        if (ratio < 0.75 || ratio > 1.33) {
                            alert('Rasio gambar terlalu ekstrem. Pastikan gambar tidak terlalu persegi panjang (lebar dan tinggi kurang lebih seimbang).');
                            resetUploadUI();
                            return;
                        }
                        // Perbarui tampilan UI jika lolos validasi
                        uploadUi.textContent = file.name;
                        uploadUi.parentElement.classList.add('has-file');
                        uploadUi.parentElement.style.borderColor = 'var(--accent-color, #2563eb)';
                        uploadUi.parentElement.style.background = '#f0f7ff';
                    };
                    img.onerror = function () {
                        URL.revokeObjectURL(this.src);
                        alert('File yang diunggah bukan gambar yang valid.');
                        resetUploadUI();
                    };
                    img.src = URL.createObjectURL(file);
                } else {
                    resetUploadUI();
                }
            });
        }

        // Intercept submit: ambil nonce segar, isi hidden input, lalu submit
        if (form && nonceInput) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const submitBtn = form.querySelector('[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Memproses...';
                }

                fetchFreshNonce()
                    .then(function (nonce) {
                        nonceInput.value = nonce;
                        form.submit();
                    })
                    .catch(function (err) {
                        console.error('Nonce error:', err);
                        alert('Terjadi kesalahan keamanan. Silakan refresh halaman dan coba lagi.');
                        if (submitBtn) {
                            submitBtn.disabled = false;
                            submitBtn.textContent = 'Kirim Ulasan';
                        }
                    });
            });
        }
    });
})();
