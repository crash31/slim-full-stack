const webpack = require('webpack');
const path = require('path');
const ExtractTextWebpackPlugin = require('extract-text-webpack-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const OptimizeCSSAssets = require('optimize-css-assets-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
// const DashboardPlugin = require('webpack-dashboard/plugin');

let config = {
  entry: path.resolve(__dirname, './assets/index.js'),
  output: {
    path: path.resolve(__dirname, './public/resources'),
    filename: 'output.js'
  },
  resolve: {
    modules: [
      path.join(__dirname, "assets"),
      "node_modules"
    ],
    extensions: ['.js', '.json', '.scss', '.css', '.jpeg', '.jpg', '.gif', '.png'],
    alias: {
      images: path.resolve(__dirname, 'assets/images')
    }
  },
  module: {
    rules: [
      {
        test: /\.js$/, // files ending with .js
        exclude: /node_modules/, // exclude the node_modules directory
        loader: 'babel-loader' // use this (babel-core) loader
      },
      {
        test: /\.scss$/, // files ending with .scss
        use: ExtractTextWebpackPlugin.extract({ // call our plugin with extract method
          fallback: 'style-loader', // fallback for any CSS not extracted
          use: ['css-loader', 'sass-loader', 'postcss-loader'] // use these loaders
        }) // end extract
      },
      {
        test: /\.(jpe?g|png|gif|svg)$/i,
        loaders: ['file-loader?context=src/assets/images/&name=images/[path][name].[ext]', {
          loader: 'image-webpack-loader',
          query: {
            mozjpeg: {
              progressive: true
            },
            gifsicle: {
              interlaced: false
            },
            optipng: {
              optimizationLevel: 4
            },
            pngquant: {
              quality: '75-90',
              speed: 3
            }
          }
        }],
        exclude: /node_modules/,
        include: __dirname
      }
    ] // end rules
  },
  plugins: [
    new ExtractTextWebpackPlugin('style.css'),
    new webpack.NamedModulesPlugin(),
    // new webpack.HotModuleReplacementPlugin(),
    new BrowserSyncPlugin(
      {
        proxy: 'http://localhost:8888',
        files: [
          {
            match: [
              '**/*.php',
              '**/*.twig'
            ],
            fn: function(event, file) {
              if(event === "change") {
                const bs = require('browser-sync').get('bs-webpack-plugin');
                bs.reload();
              }
            }
          }
        ]
      }
    )
  ],
  devtool: 'eval-source-map'
}

module.exports = config;

if (process.env.NODE_ENV === 'production') {
  module.exports.plugins.push(
    new webpack.optimize.UglifyJsPlugin(),
    new OptimizeCSSAssets()
  );
}
