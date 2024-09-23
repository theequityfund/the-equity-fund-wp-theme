/** @type {import('tailwindcss').Config} */
module.exports = {
  safelist: [
    'palette-yellow',
    'palette-maroon',
    'palette-lavender',
    'palette-teal',
    'palette-cream',
  ],

  content: ['./themes/the-equity-fund/**/*.twig', './themes/the-equity-fund/**/*.js'],
  theme: {
    fontFamily: {
      display: ['Judge', 'sans-serif'],

      sans: ['Metrify', 'sans-serif'],
      'sans-narrow': ['Metrify Narrow', 'sans-serif'],

      serif: ['Feature Text', 'serif'],
      'serif-deck': ['Feature Deck', 'serif'],
    },

    extend: {
      colors: {
        foreground: 'var(--c-foreground)',
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
        gutter: '2rem',
      },

      fontSize: {
        giant: ['clamp(5rem, 8vw, 8rem)', '0.9'],
        h2: ['clamp(2rem, 5vw, 3rem)', '1.2'],
        h3: ['clamp(1.5rem, 5vw, 2rem)', '1.2'],
        h5: ['clamp(1.25rem, 5vw, 1.5rem)', '1.2'],
      },

      maxWidth: {
        article: '800px',
        'article-wide': '1200px',
        '1/3': '33.333333%',
      },

      aria: {
        current: 'current=page',
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
