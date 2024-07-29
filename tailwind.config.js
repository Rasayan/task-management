/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            width: {
                "6/5": "32%",
                "9e": "9em",
                95: "95%",
            },
        },
    },
    plugins: [require("flowbite/plugin")],
};
