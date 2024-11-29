const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: "class",

    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
    ],
    daisyui: {
        darkTheme: "dark", // name of one of the included themes for dark mode
        base: true, // applies background color and foreground color for root element by default
        styled: true, // include daisyUI colors and design decisions for all components
        utils: true, // adds responsive and modifier utility classes
        prefix: "", // prefix for daisyUI classnames (components, modifiers and responsive class names. Not colors)
        logs: true, // Shows info about daisyUI version and used config in the console when building your CSS
        themeRoot: ":root",
        themes: [
            {
                light: {
                    ...require("daisyui/src/theming/themes")["light"],
                    primary: "#5FB4F7",
                    secondary: "teal",
                },
                dark: {
                    ...require("daisyui/src/theming/themes")["dark"],
                    primary: "#5FB4F7",
                    secondary: "teal",
                },
            },
        ],
    },
    theme: {
        extend: {
            fontFamily: {
                // sans: ["Inter", ...defaultTheme.fontFamily.sans],
            },

            colors: {
                dark: {
                    "eval-0": "#151823",
                    "eval-1": "#222738",
                    "eval-2": "#2A2F42",
                    "eval-3": "#2C3142",
                },
                theme: {
                    400: "#5FB4F7", // Shade lebih terang dari 500
                    500: "#3FA2F6", // Warna dasar
                    600: "#3181C5", // Shade lebih gelap dari 500
                },
            },
        },
    },

    plugins: [require("@tailwindcss/typography"), require("daisyui")],
};
