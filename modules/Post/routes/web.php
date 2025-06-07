<?php

use Illuminate\Support\Facades\Route;
use Modules\Post\Controllers\PostController;

Route::group(
    [
        'prefix' => config('modules.post.routes.prefix'),
        'as' => 'modules::',
        'middleware' => config('modules.post.routes.middleware'),
    ],
    function () {
        Route::resource('post', PostController::class);
    }
);
