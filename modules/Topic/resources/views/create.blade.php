<x-volt-app :title="__('laravolt::action.add') . ' Topic'">
    <x-volt-backlink url="{{ route('modules::topic.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Topic">
        {!! form()->post(route('modules::topic.store'))->horizontal()->multipart() !!}
            @include('topic::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
