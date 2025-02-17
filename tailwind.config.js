/** @type {import('tailwindcss').Config} */
module.exports = {
  safelist: [
    'palette-yellow',
    'palette-maroon',
    'palette-lavender',
    'palette-teal',
    'palette-coral',
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
        'button-foreground': 'var(--c-button-foreground)',
        'button-background': 'var(--c-button-background)',
        'button-hover-foreground': 'var(--c-button-hover-foreground)',
        'button-hover-background': 'var(--c-button-hover-background)',

        white: '#FFFFFF',
        black: '#111111',
        maroon: '#500C20',
        coral: '#EE797B',
        lavender: {
          20: 'rgba(196, 179, 255, 0.2)',
          DEFAULT: '#C4B3E0',
        },
        teal: '#18C198',
        yellow: '#FFD64A',
        cream: '#FCF6ED',

        transparent: 'transparent',
        current: 'currentColor',
        inherit: 'inherit',
      },

      spacing: {
        'site-padding': 'clamp(1rem, 5vw, 2rem)',
        'breakout-site-paddding': 'clamp(-2rem, -5vw, -1rem)',
        'topper-margin': '120px',
        'topper-margin-lg': '180px',
        'wp-admin-bar': 'var(--wp-admin--admin-bar--height)',
        gutter: '2rem',
      },

      fontSize: {
        headline: [
          'clamp(5.625rem, 20vw + 1rem, 18.75rem)',
          {
            lineHeight: '0.8',
            letterSpacing: '-0.0125em',
          },
        ],
        giant: ['clamp(4rem, 6vw, 8rem)', '0.9'],
        h1: [
          'clamp(2.25rem, 5vw + 1rem, 4.5rem)',
          {
            lineHeight: '1.1',
            letterSpacing: '-0.0125em',
          },
        ],
        h2: [
          'clamp(1.75rem, 2vw + 1rem, 3rem)',
          {
            lineHeight: '1.1',
            letterSpacing: '-0.0125em',
          },
        ],
        h3: [
          'clamp(1.5rem, 2vw + 1rem, 2.25rem)',
          {
            lineHeight: '1.1',
            letterSpacing: '-0.0125em',
          },
        ],
        h4: ['clamp(1.375rem, 2vw + 1rem, 1.75rem)', '1.2'],
        h5: ['clamp(1.25rem, 2vw + 1rem, 1.5rem)', '1.2'],
        h6: [
          'clamp(1rem, 0.5vw + 1rem, 1.5rem)',
          {
            lineHeight: '1.2',
            letterSpacing: '-0.0125em',
          },
        ],
        'basic-text': [
          'clamp(1rem, 0.58vw + 1rem, 1.375rem)',
          {
            lineHeight: '1.5',
            letterSpacing: '-0.0125em',
          },
        ],
        'body-text': [
          'clamp(1rem, 0.4vw + 1rem, 1.25rem)',
          {
            lineHeight: '1.3',
            letterSpacing: '-0.0125em',
          },
        ],
        blockquote: ['clamp(1.5rem, 2vw + 1rem, 2.25rem)', '1.1'],
        'blockquote-lg': ['clamp(1.5rem, 5vw + 1rem, 4.5rem)', '1.1'],
        'big-number': ['clamp(6.875rem, 20vw + 1rem, 17.5rem)', '0.9'],
      },

      maxWidth: {
        article: '720px',
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

      addVariant('hocus-within', ['&:hover', '&:focus-within']);
      addVariant('group-hocus-within', [':merge(.group):hover &', ':merge(.group):focus-within &']);
    },
  ],
};
