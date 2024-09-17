/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./themes/the-equity-fund/**/*.twig', './themes/the-equity-fund/**/*.js'],
  theme: {
    extend: {
      spacing: {
        'content-gutter': 'max(clamp(1rem, 5vw, 2rem), calc((100vw - 1920px) / 2))',
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
