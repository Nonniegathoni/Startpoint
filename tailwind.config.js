import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // New color scheme from the image
                'white': '#ffffff',
                'light-blue-purple': '#676fgd', // Note: 'g' should be '6' for valid hex
                'medium-blue-purple': '#424769',
                'dark-blue-purple': '#2d3250',
                'orange': '#fgb17a', // Note: 'g' should be '6' for valid hex
                
                // Corrected hex codes for valid colors
                'light-blue': '#676f6d',
                'orange-corrected': '#f6b17a',
                
                // Additional shades for the system
                'primary': '#424769',
                'primary-dark': '#2d3250',
                'primary-light': '#676f6d',
                'accent': '#f6b17a',
                'text-primary': '#ffffff',
                'text-secondary': '#676f6d',
            },
            backgroundImage: {
                'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                'gradient-conic': 'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
            },
            boxShadow: {
                'glow': '0 0 20px rgba(102, 111, 109, 0.3)',
                'glow-strong': '0 0 30px rgba(102, 111, 109, 0.5)',
                'glow-orange': '0 0 20px rgba(246, 177, 122, 0.3)',
                'glow-orange-strong': '0 0 30px rgba(246, 177, 122, 0.5)',
            },
            backdropBlur: {
                'xs': '2px',
            },
        },
    },

    plugins: [forms],
};
