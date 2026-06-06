/**
 * Modul: Validasi Form Submit Testimoni
 * Memeriksa ukuran berkas (maksimal 1MB) dan rasio dimensi gambar secara dinamis.
 *
 * @package CredibleCompany
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        const fileInput = document.getElementById('client_photo');
        const uploadUi = document.querySelector('.custom-file-upload .upload-ui span');
        
        // Fungsi untuk mereset tampilan input file dan labelnya
        function resetUploadUI() {
            if (fileInput) fileInput.value = '';
            if (uploadUi) {
                uploadUi.textContent = 'Pilih Gambar';
                uploadUi.parentElement.classList.remove('has-file');
                uploadUi.parentElement.style.borderColor = '';
                uploadUi.parentElement.style.background = '';
            }
        }
        
        if (fileInput && uploadUi) {
            fileInput.addEventListener('change', function () {
                if (this.files && this.files.length > 0) {
                    const file = this.files[0];
                    
                    // Cek ukuran berkas (1MB = 1048576 bytes)
                    if (file.size > 1048576) {
                        alert('Ukuran file foto melebihi batas maksimum 1MB.');
                        resetUploadUI();
                        return;
                    }
                    
                    // Cek rasio dimensi gambar menggunakan API Image
                    const img = new Image();
                    img.onload = function () {
                        URL.revokeObjectURL(this.src); // Lepaskan memori object URL
                        const ratio = this.width / this.height;
                        if (ratio < 0.75 || ratio > 1.33) {
                            alert('Rasio gambar terlalu ekstrem. Pastikan gambar tidak terlalu persegi panjang (lebar dan tinggi kurang lebih seimbang).');
                            resetUploadUI();
                            return;
                        }
                        
                        // Perbarui tampilan UI jika lolos seluruh validasi
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
    });
})();
