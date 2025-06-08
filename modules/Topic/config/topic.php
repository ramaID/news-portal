<?php

use App\Enums\Permission;

return [
    'routes' => [
        'enabled' => true,
        'middleware' => ['web', 'auth'],
        'prefix' => 'modules',
    ],
    'view' => [
        'layout' => 'laravolt::layouts.app',
    ],
    'menu' => [
        'enabled' => true,
    ],
    'permission' => [Permission::TOPIC_VIEW],
];
