import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import lineClamp from '@tailwindcss/line-clamp';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {
                current: 'currentColor',
                transparent: 'transparent',
                black: '#000',
                white: '#fff',
                gray: {
                    '50': '#fafafa',
                    '100': '#f5f5f5',
                    '200': '#e5e5e5',
                    '300': '#d4d4d4',
                    '400': '#a3a3a3',
                    '500': '#737373',
                    '600': '#525252',
                    '700': '#404040',
                    '800': '#262626',
                    '900': '#171717',
                    '950': '#0a0a0a'
                },
                'gray-background': '#f7f8fc',
                'blue': '#328af1',
                'blue-hover': '#2879bd',
                'yellow' : '#ffc73c',
                'red' : '#ec454f',
                'red-100' : '#fee2e2',
                'green' : '#1aab8b',
                'green-50': '#f0fdf4',
                'purple' : '#8b60ed',
            },
            spacing: {
                22: '5.5rem',
                70: '17.5rem',
                76: '19rem',
                104: '26rem',
                175: '43.75rem',
                44: '11rem'
            },
            maxWidth: {
                custom: '68.5rem',
            },
            boxShadow: {
                card: '4px 4px 15px 0 rgba(36, 37, 38, 0.08)',
                dialog: '3px 4px 15px 0 rgba(36, 37, 38, 0.22)'
            },
            fontFamily: {
                sans: ['Open Sans', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                xxs: ['0.625rem', {lineHeight: '1rem'}]
            }
        },
    },

    plugins: [
        forms,
        lineClamp
    ],
};
