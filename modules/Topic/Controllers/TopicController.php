<?php

namespace Modules\Topic\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Modules\Topic\Requests\Store;
use Modules\Topic\Requests\Update;
use Modules\Topic\Tables\TopicTableView;

class TopicController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Topic::class);

        return TopicTableView::make()->view('topic::index');
    }

    public function create()
    {
        $this->authorize('create', Topic::class);

        return view('topic::create');
    }

    public function store(Store $request)
    {
        Topic::create($request->validated());

        return to_route('modules::topic.index')->withSuccess('Topic saved');
    }

    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);

        return view('topic::edit', compact('topic'));
    }

    public function update(Update $request, Topic $topic)
    {
        $topic->update($request->validated());

        return to_route('modules::topic.index')->withSuccess('Topic saved');
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);

        $topic->delete();

        return to_route('modules::topic.index')->withSuccess('Topic deleted');
    }
}
