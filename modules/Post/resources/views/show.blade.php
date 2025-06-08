<x-volt-app :title="'Detail Post'">
    <x-volt-backlink url="{{ route('modules::post.index') }}"/>

    <x-volt-panel title="Detil Post">
        <table class="ui table definition">
        <tr><td>Id</td><td>{{ $post->id }}</td></tr>
        <tr><td>Topic Id</td><td>{{ $post->topic_id }}</td></tr>
        <tr><td>Created By</td><td>{{ $post->created_by }}</td></tr>
        <tr><td>Title</td><td>{{ $post->title }}</td></tr>
        <tr><td>Slug</td><td>{{ $post->slug }}</td></tr>
        <tr><td>Summary</td><td>{{ $post->summary }}</td></tr>
        <tr><td>Body</td><td>{{ $post->body }}</td></tr>
        <tr><td>Featured Image</td><td>{{ $post->featured_image }}</td></tr>
        <tr><td>Status</td><td>{{ $post->status }}</td></tr>
        <tr><td>Published At</td><td>{{ $post->published_at }}</td></tr>
        <tr><td>Created At</td><td>{{ $post->created_at }}</td></tr>
        <tr><td>Updated At</td><td>{{ $post->updated_at }}</td></tr>
        <tr><td>Deleted At</td><td>{{ $post->deleted_at }}</td></tr>
        </table>
    </x-volt-panel>
</x-volt-app>
