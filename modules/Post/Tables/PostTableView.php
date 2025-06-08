<?php

namespace Modules\Post\Tables;

use App\Models\Post;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\RestfulButton;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Suitable\TableView;

class PostTableView extends TableView
{
    public function source()
    {
        $query = Post::query()
            ->select(['id', 'topic_id', 'created_by', 'title', 'slug', 'status'])
            ->latest('id')
            ->with(['topic', 'writer'])
            ->autoSort()
            ->autoSearch(request('search'));

        if (!auth()->user()->hasRole('admin')) {
            $query->where('created_by', auth()->id());
        }

        return $query->paginate();
    }

    protected function columns()
    {
        return [
            Numbering::make('No'),
            Text::make('writer.name', 'Writer'),
            Text::make('title')->sortable(),
            Text::make('topic.name', 'Topic'),
            Text::make('status')->sortable(),
            Text::make('published_at')->sortable(),
            RestfulButton::make('modules::post'),
        ];
    }
}
