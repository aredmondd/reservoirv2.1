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
              fontFamily: {
                  sans: ['Inter', 'sans-serif'],
                  serif: ['Young Serif', 'serif'],
              },
              fontSize: {
                  'mega': '64px',
                  'title': '32px',
                  'body': '18px',
                  'small': '14px'
              },
              backgroundImage: {
                  'hero': "url('../public/images/wata.jpg')",
              },
              backgroundSize: {
                  'size-200': '200% 200%',
              },
              backgroundPosition: {
                  'pos-0': '0% 0%',
                  'pos-100': '100% 100%',
              },
          },
    },
    plugins: [],
  }
  
  