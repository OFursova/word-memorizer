const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            black: colors.black,
            green: colors.emerald,
            white: colors.white,
            gray: colors.trueGray,
            grey: colors.coolGray,
            indigo: colors.indigo,
            blue: colors.blue,
            red: colors.rose,
            yellow: colors.amber,
            pink: colors.pink,
            purple: colors.violet,
            lime: colors.lime,
            houseColor: {
                DEFAULT: '#0c5e98',
            }
        }
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
