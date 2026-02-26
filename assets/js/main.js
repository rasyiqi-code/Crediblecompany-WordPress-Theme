/**
 * Credible Company — Main JavaScript (Orchestrator)
 *
 * File ini berfungsi sebagai entrypoint utama.
 * Setiap modul fungsional telah dipecah ke file terpisah di /modules/
 * dan di-enqueue secara individual via WordPress.
 *
 * File modules yang tersedia:
 * - modules/menu-toggle.js    → Mobile menu hamburger toggle
 * - modules/faq-accordion.js  → FAQ section expand/collapse
 * - modules/toc-drawer.js     → TOC drawer + scrollspy (single post)
 * - modules/sidebar-drawer.js → Sidebar drawer (single testimoni)
 * - modules/load-more.js      → AJAX load more posts/testimoni
 *
 * Catatan: Setiap modul IIFE sudah self-initializing.
 * File ini hanya menjadi referensi/dokumentasi dan bisa digunakan
 * untuk logika global di masa depan.
 *
 * @package CredibleCompany
 */

// File ini sengaja minimal — semua logika ada di modules/
// Jika ada kebutuhan script global baru, tambahkan di sini.
