/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        container: {
            center: true,
            padding: "1rem",
            screens: {
                "2xl": "1400px",
                xl: "1300px",
            },
        },
        extend: {
            fontFamily: {
                "jakarta-sans": ["Plus Jakarta Sans", "sans-serif"],
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
