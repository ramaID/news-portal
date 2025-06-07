<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\AuthServiceProvider::class,
    App\Providers\EventServiceProvider::class,

    \Modules\Topic\Providers\TopicServiceProvider::class,
    \Modules\Post\Providers\PostServiceProvider::class,
];
