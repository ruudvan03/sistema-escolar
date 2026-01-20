// tailwind.config.js
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        school: {
          50: '#f0f9ff',
          100: '#e0f2fe',
          500: '#0ea5e9',
          600: '#0284c7', // Azul primario vibrante
          800: '#075985', // Azul oscuro institucional
          900: '#0c4a6e', // Navy profundo
        }
      }
    },
  },
  plugins: [],
}