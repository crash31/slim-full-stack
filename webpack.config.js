const webpack = require('webpack');
const path = require('path');
const ExtractTextWebpackPlugin = require('extract-text-webpack-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const OptimizeCSSAssets = require('optimize-css-assets-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

let config = {
  entry: './assets/javascript/index.js',
  output: {
    path: path.resolve(__dirname, './public/resources'),
    // publicPath: "/public/resources/",
    filename: 'output.js'
  },
  module: {
    rules: [
      {
        test: /\.js$/, // files ending with .js
        exclude: /node_modules/, // exclude the node_modules directory
        loader: "babel-loader" // use this (babel-core) loader
      },
      {
        test: /\.scss$/, // files ending with .scss
        use: ExtractTextWebpackPlugin.extract({ // call our plugin with extract method
          use: ['css-loader', 'sass-loader'], // use these loaders
          fallback: 'style-loader' // fallback fro any CSS not extracted
        }) // end extract
      }
    ] // end rules
  },
  plugins: [
    new ExtractTextWebpackPlugin('style.css'),
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
      },
      {
        reload: false
      }
    )
  ],
  devServer: {
    contentBase: path.resolve(__dirname, 'public'), // A directory or URL to serve HTML content from.
    // historyApiFallback: true,
    // inline: true, // inline mode (set to false to disable including client scripts like livereload)
    compress: true,
    hot: true,
    proxy: {
      "/": {
        target: {
          host: "locahost",
          protocol: "http:",
          port: 8888
        },
        changeOrigin: true,
        secure: false
      }
    }
  },
  devtool: 'eval-source-map'
}

module.exports = config;

if (process.env.NODE_ENV === 'production') {
  module.exports.plugins.push(
    new webpack.optimize.UglifyJsPlugin(),
    new OptimizeCSSAssets()
  );
}
