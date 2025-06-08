<x-volt-app :title="__('laravolt::action.add') . ' Post'">
    <x-volt-backlink url="{{ route('modules::post.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Post">
        {!! form()->post(route('modules::post.store'))->horizontal()->multipart() !!}
            @include('post::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
