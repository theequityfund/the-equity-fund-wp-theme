/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./themes/the-equity-fund/**/*.twig', './themes/the-equity-fund/**/*.js'],
  theme: {
    fontFamily: {
      display: ['Judge', 'sans-serif'],
      sans: ['Inter', 'sans-serif'],
      serif: ['Feature Deck', 'serif'],
      'serif-text': ['Feature Text', 'serif'],
    },

    colors: {
      white: '#FFFFFF',
      black: '#111111',
      maroon: '#500C20',
      lavender: '#C4B3E0',
      teal: '#18C198',
      yellow: '#FFD64A',
      cream: '#FCF6ED',

      transparent: 'transparent',
      current: 'currentColor',
      inherit: 'inherit',
    },

    extend: {
      spacing: {
        'site-padding': 'clamp(1rem, 5vw, 2rem)',
      },

      maxWidth: {
        article: '800px',
        'article-wide': '1200px',
        '1/3': '33.333333%',
      },
    },
  },
  plugins: [],
};
