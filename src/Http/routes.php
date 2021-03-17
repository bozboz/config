<?php

Route::group([
    'namespace' => 'Bozboz\Config\Http\Controllers',
    'prefix' => 'admin',
    'middleware' => 'web'
], function () {
    Route::resource('config', 'SiteConfig');
});
