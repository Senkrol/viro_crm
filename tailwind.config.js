import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';


/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],

  theme: {
    extend: {
      fontFamily: {
        sans: ['Figtree', ...defaultTheme.fontFamily.sans],
      },
      spacing: {
        '72.5': '18.125rem',
      },
      colors: {
        'white': '#ffffff',
        'black': '#1c2434',
        'viro-main': '#283655',
        'viro-second': '#4D648D',
        'viro-red': '#f1665d',
      },
      zIndex: {
        '9999': '9999',
      },
    },
  },
  plugins: [forms],
};

/*

$c_main: #283655
$c_main_half: #28365580
$c_second: #4D648D
$c_second_half: #4D648D80
$c_light: #e7e8ec
$c_gray: #B2B2B2
$c_green: #32b76c
$c_green_half: #32b76c80
$c_red: #f26065
$c_yellow: #fff432
$c_blue: #3333CC
$c_orange: #ffc107


*/