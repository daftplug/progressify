/** @type {import('tailwindcss').Config} */
export default {
  content: ['./admin/**/*.{php,js}', './admin/assets/css/*.css'],
  plugins: [require('@tailwindcss/forms')],
  root: __dirname,
};
