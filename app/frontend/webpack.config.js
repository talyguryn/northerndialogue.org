const ExtractTextPlugin = require('extract-text-webpack-plugin');
const path = require('path');

module.exports = {
  /**
   * Define entry point
   */
  entry: path.resolve(__dirname, 'src', 'entry.js'),

  /**
   * Set bundle params
   */
  output: {
    filename: 'bundle.js',
    path: path.resolve(__dirname, '..', 'public', 'public'),
    library: 'app',
  },

  /**
   * Loaders are used to transform certain types of modules
   */
  module: {
    rules: [
      /**
       * Process js files
       */
      {
        test: /\.js$/,
        exclude: [ /node_modules/ ],
        use: [
          {
            loader: 'babel-loader',
            query: {
              presets: [ 'env' ],
            },
          },
          {
            loader: 'eslint-loader',
            options: {
              fix: true,
            },
          },
        ]
      },

      /**
       * Process css files
       */
      {
        test: /\.(pcss|css)$/,
        exclude: [ /node_modules/ ],
        use: ExtractTextPlugin.extract([
          {
            loader: 'css-loader',
            options: {
              import: true,
            },
          },
          {
            loader: 'postcss-loader',
            options: {
              plugins: (loader) => [
                require('postcss-nested')(),
                require('postcss-cssnext')(),
                // require('postcss-inline-svg')(),
                // require('cssnano')()
              ],
              map: false,
            }
          }
        ]),
      },

      /**
       * Load assets files
       */
      {
        test: /\.(png|jpg|gif|svg)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[path][name].[ext]',
            },
          },
        ],
      },
    ]
  },

  /**
   * Adding plugins to configuration
   */
  plugins: [
    /** Build separated styles bundle */
    new ExtractTextPlugin('bundle.css'),
  ]
};