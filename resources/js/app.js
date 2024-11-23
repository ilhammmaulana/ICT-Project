import './bootstrap';

import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import PerfectScrollbar from 'perfect-scrollbar';

window.PerfectScrollbar = PerfectScrollbar;

document.addEventListener('alpine:init', () => {
    Alpine.data('mainState', () => {
        let lastScrollTop = 0;

        // Initialize scroll behavior
        const init = function () {
            window.addEventListener('scroll', () => {
                let st = window.pageYOffset || document.documentElement.scrollTop;
                if (st > lastScrollTop) {
                    this.scrollingDown = true;
                    this.scrollingUp = false;
                } else {
                    this.scrollingDown = false;
                    this.scrollingUp = true;
                    if (st === 0) {
                        // Reset
                        this.scrollingDown = false;
                        this.scrollingUp = false;
                    }
                }
                lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
            });
        };

        // Get saved theme from localStorage or system preference
        const getTheme = () => {
            const savedTheme = window.localStorage.getItem('dark');
            if (savedTheme !== null) {
                return JSON.parse(savedTheme); // Return saved theme if available
            }
            return (
                !!window.matchMedia &&
                window.matchMedia('(prefers-color-scheme: dark)').matches
            );
        };

        // Set theme in localStorage and apply to document
        const setTheme = (value) => {
            window.localStorage.setItem('dark', value);
            document.documentElement.setAttribute('data-theme', value ? 'dark' : 'light');
        };

        // Initialize theme on page load
        const initializeTheme = () => {
            const isDarkMode = getTheme();
            setTheme(isDarkMode); // Apply and save the theme on load
            return isDarkMode;
        };

        return {
            init,
            isDarkMode: initializeTheme(),
            toggleTheme() {
                this.isDarkMode = !this.isDarkMode;
                document
                    .getElementsByTagName("html")[0]
                    .setAttribute(
                        "data-theme",
                        this.isDarkMode ? "dark" : "light"
                    );
                setTheme(this.isDarkMode);
            },
            isSidebarOpen: window.innerWidth > 1024,
            isSidebarHovered: false,
            handleSidebarHover(value) {
                if (window.innerWidth < 1024) {
                    return;
                }
                this.isSidebarHovered = value;
            },
            handleWindowResize() {
                if (window.innerWidth <= 1024) {
                    this.isSidebarOpen = false;
                } else {
                    this.isSidebarOpen = true;
                }
            },
            scrollingDown: false,
            scrollingUp: false,
        };
    });
});

Alpine.plugin(collapse);

Alpine.start();
