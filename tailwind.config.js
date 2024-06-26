/** @type {import('tailwindcss').Config} */

export default {
    darkMode: 'class',
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.ts",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        'node_modules/preline/dist/*.js',
    ],
    theme: {
        extend: {},
    },
    plugins: [
        require('preline/plugin'),
        require('@tailwindcss/forms'),
    ],
}

