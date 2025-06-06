<?php

namespace Modules\Topic\Tables;

use App\Models\Topic;
use Laravolt\Suitable\Columns\Numbering;
use Laravolt\Suitable\Columns\RestfulButton;
use Laravolt\Suitable\Columns\Text;
use Laravolt\Suitable\TableView;

class TopicTableView extends TableView
{
    public function source()
    {
        return Topic::autoSort()->latest()->autoSearch(request('search'))->paginate();
    }

    protected function columns()
    {
        return [
            Numbering::make('No'),
            Text::make('name')->sortable(),
            Text::make('slug')->sortable(),
            Text::make('description')->sortable(),
            RestfulButton::make('modules::topic'),
        ];
    }
}
