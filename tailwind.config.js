import forms from '@tailwindcss/forms';
import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            width:{
                '1000': '1000px',
                '400': '400px',
            },
            height:{
                '700': '700px',
                '400': '400px',
            },
            padding: {
                '500': '750px',
            },
            borderRadius: {
                'custom-1': '10px',
                'custom-2': '15px',
                'custom-3': '20px',
                'custom-4': '25px',
                'custom-5': '30px',
                'custom-6': '35px',
                'custom-7': '50px',
            },
            skew: {
                '0.5': '0.5deg',
                '0.25': '0.25deg',
                '0.75': '0.75deg',
              },
            colors: {
                'custom-yellow': '#FFF8D2',
                'custom-gold': '#9D904C',
                'custom-green': '#00992C',
                'input-color': '#F7EDBD',
                'header-background': '#40341D',
              },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                'irish-grover': ['Irish Grover', 'cursive'],
            },
        },
    },

    plugins: [forms],
};
