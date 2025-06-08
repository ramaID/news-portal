<?php

namespace Modules\Post\Providers;

use Laravolt\Support\Base\BaseServiceProvider;

class PostServiceProvider extends BaseServiceProvider
{
    public function getIdentifier()
    {
        return 'post';
    }

    public function register()
    {
        $file = $this->packagePath("config/{$this->getIdentifier()}.php");
        $this->mergeConfigFrom($file, "modules.{$this->getIdentifier()}");
        $this->publishes([$file => config_path("modules/{$this->getIdentifier()}.php")], 'config');

        $this->config = collect(config("modules.{$this->getIdentifier()}"));
    }

    protected function menu()
    {
        app('laravolt.menu.builder')->register(function ($menu) {
            $menu->modules
                ->add('Post', route('modules::post.index'))
                ->data('icon', 'circle')
                ->data('permission', $this->config['permission'] ?? [])
                ->active('modules/post/*');
        });
    }
}
