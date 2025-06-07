<?php

namespace Modules\Post\Tables;

use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\RestfulButton;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Suitable\TableView;
use Modules\Post\Models\Post;

class PostTableView extends TableView
{
    public function source()
    {
        return Post::autoSort()->latest()->autoSearch(request('search'))->paginate();
    }

    protected function columns()
    {
        return [
            Numbering::make('No'),
            Text::make('topic_id')->sortable(),
            Text::make('created_by')->sortable(),
            Text::make('title')->sortable(),
            Text::make('slug')->sortable(),
            Text::make('summary')->sortable(),
            Text::make('body')->sortable(),
            Text::make('featured_image')->sortable(),
            Text::make('status')->sortable(),
            Text::make('published_at')->sortable(),
            RestfulButton::make('modules::post'),
        ];
    }
}
