const mix = require('laravel-mix')
const LodashModuleReplacementPlugin = require('lodash-webpack-plugin')

/**
 *--------------------------------------------------------------------------
 * Mix Asset Management
 *--------------------------------------------------------------------------
 *
 * Mix provides a clean, fluent API for defining some Webpack build steps
 * for your Laravel application. By default, we are compiling the Sass
 * file for the application as well as bundling up all the JS files.
 *
 */

if (mix.inProduction()) {
  mix.version()
} else {
  mix.webpackConfig({ devtool: 'inline-source-map' })
}

mix.react('resources/js/app.js', 'public/js')
  .webpackConfig({ plugins: [ new LodashModuleReplacementPlugin() ] })
  .babelConfig({
    plugins: [
      [
        'babel-plugin-styled-components',
        { pure: true }
      ],
      'babel-plugin-lodash',
      '@babel/plugin-proposal-class-properties'
    ]
  })
  .extract()
