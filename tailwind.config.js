import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Montserrat', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                burgundy: '#611232',
                'burgundy-soft': '#8B4B5F',
                gold: '#C59426',
                'gold-soft': '#D4B36B',
                'gold-lighter': '#F4E7C1'
            }
        },
    },
    plugins: [
        function({ addBase }) {
            addBase({
                'p': {
                    fontWeight: '400',
                    fontSize: '1.2rem',
                    lineHeight: '1.6',
                },
            })
        }
    ],
};
