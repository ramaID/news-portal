<?php

namespace Modules\Topic\Providers;

use Laravolt\Support\Base\BaseServiceProvider;

class TopicServiceProvider extends BaseServiceProvider
{
    public function getIdentifier()
    {
        return 'topic';
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
                ->add('Topic', route('modules::topic.index'))
                ->data('icon', 'circle')
                ->data('permission', $this->config['permission'] ?? [])
                ->active('modules/topic/*');
        });
    }
}
