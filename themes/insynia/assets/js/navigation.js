/**
 * Navigation JavaScript for Insynia Theme
 * Handles mobile menu toggle and smooth scrolling
 */

(function() {
    'use strict';

    // DOM Content Loaded
    document.addEventListener('DOMContentLoaded', function() {
        initMobileMenu();
        initStickyHeader();
        initSmoothScrolling();
    });

    /**
     * Initialize mobile menu functionality
     */
    function initMobileMenu() {
        const menuToggle = document.querySelector('.menu-toggle');
        const primaryMenu = document.querySelector('.primary-menu');

        if (!menuToggle || !primaryMenu) {
            return;
        }

        // Toggle menu on button click
        menuToggle.addEventListener('click', function() {
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';

            // Toggle aria-expanded attribute
            menuToggle.setAttribute('aria-expanded', !isExpanded);

            // Toggle menu visibility
            primaryMenu.classList.toggle('open');

            // Add body class to prevent scrolling when menu is open
            if (!isExpanded) {
                document.body.classList.add('menu-open');
            } else {
                document.body.classList.remove('menu-open');
            }
        });

        // Close menu when clicking on menu links
        const menuLinks = primaryMenu.querySelectorAll('a');
        menuLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                primaryMenu.classList.remove('open');
                menuToggle.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('menu-open');
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!menuToggle.contains(event.target) && !primaryMenu.contains(event.target)) {
                primaryMenu.classList.remove('open');
                menuToggle.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('menu-open');
            }
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && primaryMenu.classList.contains('open')) {
                primaryMenu.classList.remove('open');
                menuToggle.setAttribute('aria-expanded', 'false');
                document.body.classList.remove('menu-open');
                menuToggle.focus();
            }
        });
    }

    /**
     * Initialize sticky header functionality
     */
    function initStickyHeader() {
        const header = document.querySelector('.site-header');

        if (!header) {
            return;
        }

        let lastScrollTop = 0;

        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // Add shadow when scrolled
            if (scrollTop > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            lastScrollTop = scrollTop;
        });
    }

    /**
     * Initialize smooth scrolling for anchor links
     */
    function initSmoothScrolling() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');

        anchorLinks.forEach(function(link) {
            link.addEventListener('click', function(event) {
                const targetId = this.getAttribute('href');

                if (targetId === '#') {
                    return;
                }

                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    event.preventDefault();

                    const headerHeight = document.querySelector('.site-header').offsetHeight;
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

})();