<x-volt-app :title="__('laravolt::action.edit') . ' Topic'">
    <x-volt-backlink url="{{ route('modules::topic.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Topic">
        {!! form()->bind($topic)->put(route('modules::topic.update', $topic->getRouteKey()))->horizontal()->multipart() !!}
            @include('topic::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
