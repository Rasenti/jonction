/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './templates/**/*.html.twig',
    './assets/**/*.js'
  ],
  theme: {
    extend: {
      colors: {
        'theme-dark': '#2d2d2d',
        'theme-darker': '#232323',
        'theme-light': '#f6f6f6',
        'theme-aqua': '#2dedb9',
        'theme-aqua-darker': '#26cfa2',
      },
    },
  },
  plugins: [],
}

