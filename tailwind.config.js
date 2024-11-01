const defaultTheme = require('tailwindcss/defaultTheme')

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                dark: {
                    'eval-0': '#151823',
                    'eval-1': '#222738',
                    'eval-2': '#2A2F42',
                    'eval-3': '#2C3142',
                },
                theme: {
                    400: '#5FB4F7', // Shade lebih terang dari 500
                    500: '#3FA2F6', // Warna dasar
                    600: '#3181C5', // Shade lebih gelap dari 500
                },
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('daisyui')],
}
