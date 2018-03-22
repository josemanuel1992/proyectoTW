const path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
// const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

const javascript = {
  test: /\.(js)?$/,
  exclude: /(node_modules|bower_components)/,
  use: {
    loader: 'babel-loader',
    options: {
      presets: ['env']
    }
  }
};

const scss = {
  test: /\.(scss)$/,
  use: ExtractTextPlugin.extract({
    use: [
      {
        loader: 'css-loader',
        options: {
          url: false,
          minimize: true
        }
      },
      {
        loader: 'postcss-loader', options: {
          sourceMap: true,
          plugins() {
            return [require('autoprefixer')({browsers: 'last 3 versions'})]
          }
        }
      },
      'sass-loader?sourceMap'
    ]
  })
};

const config = {
      entry: {
        app: './src/js/app.js'
      },
      output: {
        filename: '[name].bundle.js',
        path: path.resolve(__dirname, 'public/dist'),
      },
      devtool: 'source-map',
      module: {
        rules: [scss, javascript]
      },
      plugins: [
        new ExtractTextPlugin('styles.css'),
        // new UglifyJsPlugin(),
      ]
    }
;

module.exports = config;