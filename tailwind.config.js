/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./themes/the-equity-fund/**/*.twig', './themes/the-equity-fund/**/*.js'],
  theme: {
    fontFamily: {
      display: ['Judge', 'sans-serif'],
      sans: ['Inter', 'sans-serif'],
      serif: ['Feature Text', 'serif'],
      'serif-deck': ['Feature Deck', 'serif'],
    },

    extend: {
      colors: {
        primary: 'var(--c-primary)',
        background: 'var(--c-background)',

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

      spacing: {
        'site-padding': 'clamp(1rem, 5vw, 2rem)',
        'topper-margin': '120px',
        'wp-admin-bar': 'var(--wp-admin--admin-bar--height)',
      },

      fontSize: {
        h2: ['clamp(2rem, 5vw, 3rem)', '1.2'],
        h5: ['clamp(1.25rem, 5vw, 1.5rem)', '1.2'],
      },

      maxWidth: {
        article: '800px',
        'article-wide': '1200px',
        '1/3': '33.333333%',
      },
    },
  },
  plugins: [
    function({ addVariant }) {
      addVariant('hocus', ['&:hover', '&:focus']);
      addVariant('group-hocus', [':merge(.group):hover &', ':merge(.group):focus &']);
    },
  ],
};
