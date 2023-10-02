/** @type {import('tailwindcss').Config} */
export default {
  content: [
    // "./resources/views/layouts/app.blade.php" // Agregar estilos tailwind a app.blade
    "./resources/**/*.blade.php", // Agregar estilos tailwind a todas las plantillas blade dentro de resources (y dentro de las carpetas de resources)
    "./resources/**/*.js", // A los archivos js también
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

