/** @type {import('tailwindcss').Config} */
export default {
  content: ['./admin/**/*.{php,js}', './admin/assets/css/*.css'],
  plugins: [require('@tailwindcss/forms')],
  darkMode: ['selector', 'html.dark:has(#daftplugAdmin)'],
  root: __dirname,
};
