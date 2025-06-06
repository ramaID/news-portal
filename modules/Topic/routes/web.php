<?php

use Illuminate\Support\Facades\Route;
use Modules\Topic\Controllers\TopicController;

Route::group(
    [
        'prefix' => config('modules.topic.routes.prefix'),
        'as' => 'modules::',
        'middleware' => config('modules.topic.routes.middleware'),
    ],
    function () {
        Route::resource('topic', TopicController::class)->except('show');
    }
);
