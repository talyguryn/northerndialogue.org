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
              presets: [ '@babel/preset-env' ],
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
          'postcss-loader'
        ]),
      },

      /**
       * Load assets files
       */
      {
        test: /\.(png|jpg|jpeg|gif|svg)$/,
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