import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                inter: ["Inter", "sans-serif"],
                jakarta: ["Plus Jakarta Sans", "sans-serif"],
                outfit: ["Outfit", "sans-serif"],
                sora: ["Sora", "sans-serif"],
            },
        },
    },

    plugins: [forms],
};
