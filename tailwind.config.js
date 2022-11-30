const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                'google-icon':['Material Icons'],
                'google-icon-outlined':['Material Symbols Outlined']
            },
            colors: {
                'primary':'#111827',
                'primary-focus':'#EAB308',
                'primary-hover':'#374151',
                'secondary':'#73581C',
                'secondary-focus':'#EAB308',
                'secondary-bring':'#D32525',
                'success':'#22C55E',
                'warning':'#EAB308',
                'error':'#EF4444',
                'info':'#3B82F6',
            },
            spacing: {
                '18': '4.5rem',
                '22': '5.5rem',
                '26': '6.5rem',
                '30': '7.5rem',
                '128': '32rem',
            }
        },
    },

    plugins: [require('@tailwindcss/typography')],
};
