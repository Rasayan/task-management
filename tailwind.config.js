/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      width: {
        '6/5': '32%',
        '9e': '9em'
      }
    },
  },
  plugins: [],
}