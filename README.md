# Credible Company — WordPress Theme

![WordPress](https://img.shields.io/badge/WordPress-v6.0+-21759B?style=for-the-badge&logo=wordpress&logoColor=white)
![Language](https://img.shields.io/badge/PHP-7.4+-777BB4?style=for-the-badge&logo=php&logoColor=white)

**Credible Company** adalah tema WordPress premium yang dirancang khusus untuk landing page perusahaan dengan pendekatan *mobile-first* dan *app-like experience*. Tema ini ringan, cepat, dan mudah dikonfigurasi melalui WordPress Customizer.

## ✨ Fitur Unggulan

- 📱 **Mobile-First Design**: Antarmuka yang menyerupai aplikasi (Sticky Mobile Header, Drawer Navigation).
- 💬 **Floating WhatsApp Chat**: Tombol chat melayang dengan animasi pulse dan pesan default yang dapat disesuaikan.
- 🛠️ **Modular CSS & JS**: Kode yang terstruktur rapi menggunakan pattern `@import` untuk CSS dan ES Modules untuk JavaScript.
- 🎯 **Custom Post Types**: Dilengkapi dengan CPT khusus untuk **Paket Jasa** dan **Testimoni**.
- ⚙️ **Advanced Customizer**: Atur semua konten landing page (Hero, Statistik, Fitur, Harga, Kontak) langsung dari panel kustomisasi WordPress.
- 📄 **TOC Generator**: Daftar isi otomatis untuk artikel blog guna meningkatkan SEO dan pengalaman baca.

## 🚀 Instalasi

1. Unduh atau clone repository ini ke folder `/wp-content/themes/crediblecompany`.
2. Masuk ke Dashboard WordPress Anda.
3. Buka menu **Tampilan > Tema**.
4. Cari **Credible Company** dan klik **Aktifkan**.

## ⚙️ Konfigurasi Utama

### Floating WhatsApp Chat
1. Buka **Dashboard > Tampilan > Sesuaikan**.
2. Pilih panel **Pengaturan Homepage > Social Media**.
3. Isi kolom **Nomor WhatsApp** dengan format internasional tanpa tanda `+` (contoh: `6281234567890`).
4. (Opsional) Sesuaikan **Pesan Default WhatsApp** yang akan dikirim oleh pengunjung.

### Pengaturan Landing Page
Gunakan panel **Pengaturan Homepage** di Customizer untuk mengubah konten Hero, Statistik, Fitur, hingga FAQ tanpa menyentuh kode.

## 📂 Struktur Folder

```text
├── assets/             # Aset statis (CSS, JS, Gambar)
│   ├── css/            # Modular CSS (Base, Components, Sections, Responsive)
│   └── js/             # Modular JS (Modules)
├── inc/                # Logika PHP & Integrasi (Customizer, CPT, Helpers)
├── template-parts/     # Potongan template untuk modularitas tampilan
├── functions.php       # Entry point logika tema
└── style.css           # Informasi tema & Global styles
```

## 👨‍💻 Kontribusi

Silakan buka *Issue* atau kirimkan *Pull Request* jika Anda ingin memberikan saran atau perbaikan.

---
**Dikembangkan oleh [rasyiqi-code](https://github.com/rasyiqi-code)**
