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
            'white' : '#E9F4F6',
            'midnight' : '#0A1826',
            'blue': '#3B92E5',
            'slate': '#1F4245',
            'aqua': '#6AE1EB',
            'transparent': 'transparent',
        },
      },
    },
    plugins: [],
  }