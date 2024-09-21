const mix = require("laravel-mix");
require("laravel-mix-purgecss");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .copy("resources/img", "public/img")
    .sass("resources/sass/app.scss", "public/css")
    /** Admin */
    .scripts(["resources/js/company.js"], "public/js/company.js")
    .scripts(["resources/js/address.js"], "public/js/address.js")
    .scripts(["resources/js/phone.js"], "public/js/phone.js")
    .scripts(
        ["resources/js/document-person.js"],
        "public/js/document-person.js"
    )
    .scripts(["resources/js/kanban.js"], "public/js/kanban.js")
    .scripts(["resources/js/money.js"], "public/js/money.js")
    .scripts(["resources/js/image-delete.js"], "public/js/image-delete.js")
    .scripts(["resources/js/image-order.js"], "public/js/image-order.js")
    /** Web */
    .copy(
        "node_modules/bootstrap/dist/css/bootstrap.min.css",
        "public/css/bootstrap.css"
    )
    .sass("resources/sass/site/site.scss", "public/css")
    .scripts("resources/js/bootstrap.js", "public/js/bootstrap.js")
    .scripts(
        "resources/js/properties-filter.js",
        "public/js/properties-filter.js"
    )
    .scripts("resources/js/cookie.js", "public/js/cookie.js")
    .scripts("resources/js/button-top.js", "public/js/button-top.js")
    /** Campaign */
    .sass("resources/sass/campaign/default/app.scss", "public/css/campaign/default.css")
    .options({
        processCssUrls: false,
    })
    .sourceMaps()
    .purgeCss();
