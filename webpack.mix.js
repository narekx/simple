const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */


mix
  .js('resources/js/index.js', 'public/static/mix/js')
  .sass('resources/scss/main.scss', 'public/static/mix/css').options({ processCssUrls: false });

// Versioning
if (mix.inProduction())
  mix.version();
else
  mix.sourceMaps()

mix.browserSync(process.env.APP_URL);