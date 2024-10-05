/** @type {import('tailwindcss').Config} */
export default {
  content: ['./admin/**/*.{php,js}', './admin/assets/css/*.css', './node_modules/preline/dist/*.js'],
  plugins: [require('@tailwindcss/forms'), require('preline/plugin')],
  darkMode: ['selector', 'html.dark:has(#daftplugAdmin)'],
  root: __dirname,
};
