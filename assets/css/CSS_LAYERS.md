# CSS Architecture — Crediblecompany Theme

Dokumen ini menjelaskan aturan dimana CSS harus ditambahkan, dan kapan harus membuat file baru.

---

## Struktur Direktori

```
assets/css/
├── main.css               ← Hub landing page (import base + components + sections)
├── responsive.css         ← Hub responsive (import responsive/)
├── landing-mobile.css     ← Hub mobile override (import landing/), hanya di front-page & home
│
├── base/                  ← Fondasi desain
│   ├── variables.css      ← CSS Custom Properties: warna, spacing, typography, shadows
│   ├── reset.css          ← Normalisasi browser default
│   └── utilities.css      ← Helper class: .container, .text-center, .flex-between, dll.
│
├── components/            ← Elemen UI reusable yang muncul di banyak halaman
│   ├── header.css         ← Navigasi desktop (sticky, dropdown)
│   ├── footer.css         ← Footer layout & widget area
│   ├── search.css         ← Halaman hasil pencarian
│   ├── floating-whatsapp.css ← Tombol WA floating
│   └── cards/             ← Komponen card — pisahkan per jenis
│       ├── blog-card.css     ← Card post blog (style grid)
│       ├── featured-card.css ← Card featured post (horizontal)
│       └── testimonial-card.css ← Card testimoni
│
├── sections/              ← Section-section landing page (scroll sections)
│   ├── hero.css
│   ├── about-features.css
│   ├── pricing.css
│   ├── testimonials.css
│   ├── partners.css
│   ├── books.css
│   ├── blog.css
│   ├── faq-cta.css
│   └── page.css           ← Halaman statis (page.php, 404, dll.)
│
├── responsive/            ← Breakpoint override untuk halaman non-landing
│   ├── app-layout.css        ← Layout app-style (single post, single testimoni, search)
│   ├── blog-responsive.css   ← Grid blog di berbagai breakpoint
│   ├── comments.css          ← Komentar post
│   ├── forms.css             ← Form submit testimoni
│   ├── landing-responsive.css ← Override minor landing page di tablet/desktop
│   ├── mobile-enhancements.css ← Tweaks mobile lintas halaman
│   ├── premium-cards.css     ← Card premium style (desktop enhancement)
│   ├── testimoni-app.css     ← Halaman arsip/single testimoni
│   └── toc-sidebar.css       ← TOC sidebar (single post)
│
└── landing/               ← Override khusus tampilan mobile landing page
    ├── header-mobile.css  ← Header/nav di mobile
    ├── layout-mobile.css  ← Layout kolom/grid di mobile
    └── sections-mobile.css ← Section-specific tweaks di mobile
```

---

## Aturan Penempatan — Keputusan Singkat

| Pertanyaan | Jawaban | Taruh di |
|---|---|---|
| Muncul di semua halaman? | Ya | `components/` |
| Hanya di landing page? | Ya | `sections/` |
| Media query untuk landing? | Tablet/desktop | `responsive/landing-responsive.css` |
| Media query untuk landing? | Mobile | `landing/` |
| Halaman app (post/testimoni)? | Ya | `responsive/app-layout.css` atau `responsive/testimoni-app.css` |
| Komponen card baru? | Ya | `components/cards/` (file baru per card type) |
| CSS Custom Property baru? | Ya | `base/variables.css` |
| Utility class baru? | Ya | `base/utilities.css` |

---

## Aturan Wajib

1. **Jangan tulis media query di `base/`** — base tidak punya context halaman.
2. **Jangan duplikasi variable** — semua nilai warna/spacing harus dari `variables.css`.
3. **Jangan taruh breakpoint di `sections/`** untuk perubahan mobile drastis — gunakan `landing/`.
4. **`main.css`, `responsive.css`, `landing-mobile.css`, `cards.css`** hanya boleh berisi `@import`.
5. **Nama class baru** harus gunakan prefix `cc-` atau BEM-style `.block__element--modifier`.

---

## Cara Menambah CSS Baru

### Tambah section landing page baru
1. Buat `assets/css/sections/nama-section.css`
2. Tambahkan `@import url('./sections/nama-section.css');` di `main.css`

### Tambah komponen baru
1. Buat `assets/css/components/nama-komponen.css`
2. Tambahkan `@import url('./components/nama-komponen.css');` di `main.css`

### Tambah CSS mobile landing baru
1. Taruh di `assets/css/landing/sections-mobile.css` (atau buat file baru di `landing/`)
2. Tambahkan `@import` di `landing-mobile.css`

### Tambah CSS halaman app (non-landing)
1. Taruh di `assets/css/responsive/` — pilih file yang paling relevan
2. Atau buat file baru dan tambahkan `@import` di `responsive.css`
