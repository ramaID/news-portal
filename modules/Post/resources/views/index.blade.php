<x-volt-app :title="'Post'">
    <x-slot name="actions">
        <x-volt-link-button
            :url="route('modules::post.create')"
            icon="plus"
            :label="__('laravolt::action.add')"
        />
    </x-slot>

    {!! $table !!}
</x-volt-app>
