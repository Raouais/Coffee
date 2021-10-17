const path = require('path');

module.exports = {
  entry: {
    room : './js/Room/index.js',
    api: './js/Api/Api.js',
    command:'./js/Command/admin.js'
  },
  mode: 'none',
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'dist'),
  },
    devServer: {
        static: './dist',
    },
  module:{
      rules:[
          {
              test:/\.css$/i,
              use:['style-loader','css-loader'],
          },
          {
            test: /\.(png|svg|jpg|jpeg|gif)$/i,
            type: 'asset/resource',
          },
      ],
  },
};