import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class', // Enable dark mode via class

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                gradient4a: '#DED1C6',
                gradient4b: '#A77693',
                gradient4c: '#174871',
                gradient4d: '#0F2D4D',
            },
            backgroundImage: {
                'gradient-4': 'linear-gradient(135deg, #DED1C6 0%, #A77693 40%, #174871 80%, #0F2D4D 100%)',
            },
        },
    },

    plugins: [forms],
};
