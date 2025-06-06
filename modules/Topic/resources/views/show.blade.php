<x-volt-app :title="'Detail Topic'">
    <x-volt-backlink url="{{ route('modules::topic.index') }}"/>

    <x-volt-panel title="Detil Topic">
        <table class="ui table definition">
        <tr><td>Id</td><td>{{ $topic->id }}</td></tr>
        <tr><td>Name</td><td>{{ $topic->name }}</td></tr>
        <tr><td>Slug</td><td>{{ $topic->slug }}</td></tr>
        <tr><td>Description</td><td>{{ $topic->description }}</td></tr>
        <tr><td>Created At</td><td>{{ $topic->created_at }}</td></tr>
        <tr><td>Updated At</td><td>{{ $topic->updated_at }}</td></tr>
        <tr><td>Deleted At</td><td>{{ $topic->deleted_at }}</td></tr>
        </table>
    </x-volt-panel>
</x-volt-app>
