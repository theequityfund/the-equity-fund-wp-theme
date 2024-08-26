const path = require('path');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const Dotenv = require('dotenv-webpack');

module.exports = env => ({
  mode: process.env.NODE_ENV === 'production' ? 'production' : 'development',

  // NOTE: Scripts for blocks are compiled separately using wp-scripts in package.json

  entry: {
    app: [
      'core-js/stable',
      'regenerator-runtime/runtime',
      path.resolve(__dirname, 'static/js/app.js'),
      path.resolve(__dirname, 'static/scss/app.scss'),
    ],
    admin: [
      path.resolve(__dirname, 'static/js/admin.js'),
      path.resolve(__dirname, 'static/scss/admin.scss'),
    ],
  },

  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'dist/static'),
    publicPath: '/wp-content/themes/the-equity-fund/dist/static/',
  },

  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        loader: 'babel-loader',
      },
      {
        test: /\.scss$/,
        use: [
          MiniCssExtractPlugin.loader,
          'css-loader',
          'postcss-loader',
          {
            loader: 'sass-loader',
            options: {
              implementation: require('sass'),
            },
          },
        ],
      },
      {
        test: /\.(png|svg|jpg|gif)$/,
        loader: 'file-loader',
        options: {
          name: '[name].[ext]',
          outputPath: 'img',
        },
      },
      {
        test: /\.(woff|woff2|eot|ttf|otf)$/,
        loader: 'file-loader',
        options: {
          name: '[name].[ext]',
          outputPath: 'fonts',
        },
      },
    ],
  },

  optimization: {
    splitChunks: {
      cacheGroups: {
        commons: {
          test: /[\\/]node_modules[\\/]/,
          name: 'vendor',
          chunks: 'all',
          enforce: true,
        },
      },
    },
  },

  resolve: {
    alias: {
      '@src': path.resolve(__dirname, 'static/js'),
    },
  },

  plugins: [
    // https://www.npmjs.com/package/dotenv-webpack
    new Dotenv(),
    // https://www.npmjs.com/package/browser-sync-webpack-plugin
    new BrowserSyncPlugin({
      host: 'localhost',
      port: 3000,
      proxy: env
        ? env.platform === 'ups-dock'
          ? 'http://the-equity-fund.ups.dock'
          : 'http://localhost:8888/'
        : 'http://localhost:8888/',
      files: ['*.php', 'templates/**/*.twig'],
      open: false,
      ghostMode: false,
      notify: false,
    }),
    // https://www.npmjs.com/package/mini-css-extract-plugin
    new MiniCssExtractPlugin({
      filename: '[name].css',
      chunkFilename: '[id].css',
    }),
  ],

  devtool: process.env.NODE_ENV === 'production' ? 'source-map' : 'inline-source-map',
});
