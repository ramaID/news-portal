<?php

namespace Modules\Post\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Modules\Post\Requests\Store;
use Modules\Post\Requests\Update;
use Modules\Post\Tables\PostTableView;

class PostController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Post::class); // Otorisasi

        return PostTableView::make()->view('post::index');
    }

    public function create()
    {
        $this->authorize('create', Post::class); // Otorisasi

        return view('post::create');
    }

    public function store(Store $request)
    {
        $attributes = $request->validated();
        $post = Post::create($attributes);

        if ($attributes['status'] === 'published') {
            $post->update(['published_at' => now()]);
        }

        return to_route('modules::post.show', $post)->withSuccess('Post saved');
    }

    public function show(Post $post)
    {
        $this->authorize('show', $post); // Otorisasi

        $post->load(['topic', 'writer']);

        return view('post::show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post); // Otorisasi

        return view('post::edit', compact('post'));
    }

    public function update(Update $request, Post $post)
    {
        $attributes = $request->validated();
        $post->update($attributes);

        if ($attributes['status'] === 'published') {
            $post->update(['published_at' => now()]);
        }

        return to_route('modules::post.show', $post)->withSuccess('Post saved');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post); // Otorisasi

        $post->delete();

        return to_route('modules::post.index')->withSuccess('Post deleted');
    }
}
