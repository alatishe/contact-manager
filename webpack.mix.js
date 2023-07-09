const mix = require('laravel-mix');
//const { VueLoaderPlugin } = require('vue-loader');

mix.webpackConfig({
  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader'
      }
    ]
  },
//   plugins: [
//     new VueLoaderPlugin()
//   ]
});

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
