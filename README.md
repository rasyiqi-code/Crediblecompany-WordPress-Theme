# Credible Company — WordPress Theme

![WordPress](https://img.shields.io/badge/WordPress-v6.0+-21759B?style=for-the-badge&logo=wordpress&logoColor=white)
![Language](https://img.shields.io/badge/PHP-7.4+-777BB4?style=for-the-badge&logo=php&logoColor=white)

**Credible Company** adalah tema WordPress premium yang dirancang khusus untuk landing page perusahaan dengan pendekatan *mobile-first* dan *app-like experience*. Tema ini ringan, cepat, dan mudah dikonfigurasi melalui WordPress Customizer.

## ✨ Fitur Unggulan

- 📱 **Mobile-First Design**: Antarmuka yang menyerupai aplikasi (Sticky Mobile Header, Drawer Navigation).
- 💬 **Floating WhatsApp Chat**: Tombol chat melayang dengan animasi pulse dan pesan default yang dapat disesuaikan.
- 🔗 **Dynamic WhatsApp Routing**: Sistem pelacakan cerdas berbasis Cookie & CPT Marketing untuk skenario Auto Switch Nomer WA berdasarkan referal Sales (`?ref=sales`). Fitur ini dilengkapi String Personalization.
- 🛠️ **Modular CSS & JS**: Kode yang terstruktur rapi menggunakan pattern `@import` untuk CSS dan ES Modules untuk JavaScript.
- 🎯 **Custom Post Types**: Dilengkapi dengan CPT khusus untuk **Paket Jasa**, **Marketing**, dan **Testimoni**.
- ⚙️ **Advanced Customizer**: Atur semua konten landing page (Hero, Statistik, Fitur, Harga, Kontak) langsung dari panel kustomisasi WordPress.
- 🚀 **Smooth Scroll & Anchor IDs**: Navigasi antar-section yang mulus menggunakan sistem anchor link (`#id`).
- 🔍 **SEO Optimized FAQ**: Bagian FAQ kini dilengkapi dengan Schema JSON-LD (FAQPage) otomatis untuk Google Rich Results.
- 📄 **TOC Generator**: Daftar isi otomatis untuk artikel blog guna meningkatkan SEO dan pengalaman baca.

## 🚀 Instalasi

1. Unduh atau clone repository ini ke folder `/wp-content/themes/crediblecompany`.
2. Masuk ke Dashboard WordPress Anda.
3. Buka menu **Tampilan > Tema**.
4. Cari **Credible Company** dan klik **Aktifkan**.

## ⚙️ Konfigurasi Utama

### Dynamic WhatsApp Routing & Personalization (Fitur Canggih)
Tema ini memiliki sistem referal *native* sehingga tiap-tiap agen marketing ("Sales") bisa memiliki link masing-masing untuk disebar tanpa harus men-generate landing page baru.
1. Buka **Dashboard > Tim Marketing > Tambah Marketing Baru**.
2. Masukkan nama agen (contoh: "Thanos") dan konfigurasikan Nomor WhatsApp spesifik untuk dia.
3. (Opsional) Sesuaikan teks chat pre-filled yang unik di bagian **Teks Pembuka WA**. Admin bisa menyisipkan parameter nama agen otomatis (`{Nama Marketing}`) seperti: `"Halo kak {Nama Marketing}..."`.
4. Berikan URL referal (misalnya: `domainanda.com/?ref=thanos`) ke agen yang bersangkutan.
5. Saat pelanggan datang melalui referal tersebut, seluruh tautan CTA & Kontak WhatsApp di web akan otomatis berubah tujuan nomor ke agen tersebut dan mengganti tag tulisan `{Nama Marketing}` di UI menjadi *Thanos* (misal: tombol `"Hubungi {Nama Marketing}"` menjadi `"Hubungi Thanos"`).

### Floating WhatsApp Chat (Default)
1. Buka **Dashboard > Tampilan > Sesuaikan**.
2. Pilih panel **Pengaturan Homepage > Social Media** (Atau bisa juga langsung pada block CTA).
3. Isi kolom **Nomor WhatsApp**, ini akan menjadi default jika pelanggan datang murni organik (tanpa referal parameter agen mana pun).
4. (Opsional) Sesuaikan panel **Pesan** yang ada. Ini menjadi nilai fallback.

### Pengaturan Landing Page
Gunakan panel **Pengaturan Homepage** di Customizer untuk mengubah konten Hero, Statistik, Fitur, hingga FAQ tanpa menyentuh kode.
- **Marketing Options**: Tambahkan "Fallback Nama Marketing" (misal: "Admin" atau "Tim CS") jika pengunjung tidak lewat link referal.

### Anchor Navigation (Section IDs)
Gunakan ID berikut pada kolom URL tombol atau menu di Customizer untuk membuat navigasi *scroll* halus ke bagian tertentu:

| ID Section | Deskripsi Bagian |
| :--- | :--- |
| `#hero` | Bagian Atas / Hero Utama |
| `#how-it-works` | Fitur & Keunggulan (Mengapa Memilih Kami) |
| `#daftar-paket` | Daftar Harga & Paket Jasa Penerbitan |
| `#books` | Katalog Buku Terbitan |
| `#testimonials` | Testimoni Mitra/Pelanggan |
| `#blog` | Artikel & Berita Terbaru |
| `#faq` | Tanya Jawab (FAQ) |
| `#mitra` | Logo Mitra & Partner Kerja |

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
