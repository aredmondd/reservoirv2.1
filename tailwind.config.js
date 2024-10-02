/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
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
            backgroundSize: {
                'size-200': '200% 200%',
            },
            backgroundPosition: {
                'pos-0': '0% 0%',
                'pos-100': '100% 100%',
            },
            animation : {
              "loop-scroll": "loop-scroll 200s linear infinite",
            },
            keyframes: {
              "loop-scroll": {
                  from: { transform: "translateX(0)" },
                  to: { transform: "translateX(-100%)" },
              },
            },
            boxShadow: {
                'glow': '0px 0px 25px 0px #6AE1EB',
            },
            screens: {
                '3xl' : '1900px',
            }
        },
    },
};
