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
            backgroundImage: {
                'pagination-hover': "url('/images/PaginationBackgroundHover.svg')",
              },
            colors: {
                'custom-yellow': '#FFF8D2',
                'custom-gold': '#9D904C',
                'custom-green': '#00992C',
                'input-color': '#F7EDBD',
                'header-background': '#40341D',
                'cursor': '#F27114',
                'edit': '#E8FF5B',
              },
            fontFamily: {
                sans: ['irish-grover', ...defaultTheme.fontFamily.sans],
                'irish-grover': ['Irish Grover', 'cursive'],
            },
        },
    },

    plugins: [forms,
        function ({addUtilities}){
            addUtilities({
                '.custom-cursor':{
                    cursor: 'url(/images/Custom-Cursor.svg), auto',
                },
            }, ['responsive', 'hover']);
        },
    ],
};
