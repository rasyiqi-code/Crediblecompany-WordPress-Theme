/**
 * Modul: FAQ Accordion
 * Menangani expand/collapse item FAQ (single-open mode).
 *
 * @package CredibleCompany
 */
(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(function (item) {
            const question = item.querySelector('.faq-question');

            if (question) {
                question.addEventListener('click', function () {
                    // Tutup item lain (accordion single-open)
                    faqItems.forEach(function (other) {
                        if (other !== item) {
                            other.classList.remove('active');
                        }
                    });

                    // Toggle item yang diklik
                    item.classList.toggle('active');
                });
            }
        });
    });
})();
