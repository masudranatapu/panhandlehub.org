const mix = require('laravel-mix');
require('laravel-mix-purgecss');


// Backend CSS
// ==============================================================
mix.combine([
        'public/backend/dist/css/adminlte-variable.min.css',
        'public/backend/plugins/toastr/toastr.min.css',
        'public/backend/plugins/flagicon/dist/css/flag-icon.min.css',
        'public/backend/plugins/flagicon/dist/css/bootstrap-iconpicker.min.css',
        'public/backend/css/google-font.css',
        'public/backend/css/zakirsoft.css'
    ],
    'public/backend/css/vendor.min.css'
).purgeCss({
    enabled: true,
});

// Backend CSS
// ==============================================================
mix.js('resources/js/app.js', 'public/frontend/js/chat.js').vue();

mix.combine([
    'public/backend/plugins/jquery/jquery.min.js',
    'public/backend/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'public/backend/plugins/toastr/toastr.min.js',
    'public/backend/dist/js/adminlte.min.js',
], 'public/backend/js/vendor.min.js');

// Frontend CSS
// ==============================================================
mix.combine([
    'public/frontend/css/bootstrap.min.css',
    'public/backend/plugins/toastr/toastr.min.css',
    'public/frontend/css/zakirsoft.css',
    'public/frontend/css/rtl.css',
    'public/frontend/css/sweet-alert.css',
], 'public/frontend/css/vendor.min.css' ).purgeCss({
    enabled: true,
});


// Frontend JS
// ==============================================================
mix.combine([
    'public/frontend/js/plugins/jquery.min.js',
    'public/frontend/js/plugins/bootstrap.bundle.min.js',
    'public/backend/plugins/toastr/toastr.min.js',
    'public/frontend/js/sweet-alert.min.js',
    'public/frontend//js/plugins/lan.js',
    'public/frontend/js/plugins/app.js',
], 'public/frontend/js/vendor.min.js');

