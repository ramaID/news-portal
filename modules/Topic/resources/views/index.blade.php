<x-volt-app :title="'Topic'">
    <x-slot name="actions">
        <x-volt-link-button
            :url="route('modules::topic.create')"
            icon="plus"
            :label="__('laravolt::action.add')"
        />
    </x-slot>

    {!! $table !!}
</x-volt-app>
