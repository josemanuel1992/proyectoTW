const path = require('path');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
// const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

const config = {
    entry: {
      app: './src/js/app.js'
    },
    output: {
      filename: '[name].bundle.js',
      path: path.resolve(__dirname, 'public/dist')
    },
    devtool: 'source-map',
    devServer: {
      contentBase: 'public/dist',
      watchContentBase: true,
    },
    module: {
      rules: [
        {
          test: /\.(js)?$/,
          exclude: /(node_modules|bower_components)/,
          use: {
            loader: 'babel-loader',
            options: {
              presets: ['env']
            }
          }
        },
        {
          test: /\.(scss)$/,
          use: ExtractTextPlugin.extract({
            use: [
              {
                loader: 'css-loader', options: {minimize: true}
              },
              {
                loader: 'postcss-loader', options: {
                  plugins() {
                    return [require('autoprefixer')({browsers: 'last 3 versions'})]
                  }
                }
              },
              'sass-loader'
            ]
          })
        }
      ]
    },
    plugins: [
      new ExtractTextPlugin('styles.css'),
      // new UglifyJsPlugin(),
    ]
  }
;

module.exports = config;