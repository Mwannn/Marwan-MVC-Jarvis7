/** @type {import('tailwindcss').Config} */
export default {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        colors: {
            // Jarvis Color Palette
            'primary': '#00f3ff', // Cyan
            'secondary': '#0066cc', // Deep Blue
            'bg-dark': '#0a0a12', // Dark Background
            'panel-dark': 'rgba(10, 10, 18, 0.8)',
            'success': '#00ff9d',
            'warning': '#ffbd00',
            'danger': '#ff0055',
        },
        fontFamily: {
            'mono': ['"Roboto Mono"', 'monospace'],
            'sans': ['"Orbitron"', 'sans-serif'], // Sci-fi font if available
        }
      },
    },
    plugins: [],
  }
