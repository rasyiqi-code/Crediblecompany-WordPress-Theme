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
                    // Toggle item yang diklik
                    const isActive = item.classList.toggle('active');
                    question.setAttribute('aria-expanded', isActive ? 'true' : 'false');

                    // Update aria-expanded untuk item lain yang tertutup
                    faqItems.forEach(function (other) {
                        if (other !== item) {
                            other.classList.remove('active');
                            const otherIdx = other.querySelector('.faq-question');
                            if (otherIdx) otherIdx.setAttribute('aria-expanded', 'false');
                        }
                    });
                });
            }
        });
    });
})();
