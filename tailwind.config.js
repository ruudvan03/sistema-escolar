/** @type {import('tailwindcss').Config} */
export default {
  content: [
    // Aquí le decimos a Tailwind dónde buscar clases HTML
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}