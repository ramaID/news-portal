<x-volt-app :title="__('laravolt::action.edit') . ' Post'">
    <x-volt-backlink url="{{ route('modules::post.index') }}"></x-backlink>

    <x-volt-panel title="Tambah Post">
        {!! form()->bind($post)->put(route('modules::post.update', $post->getRouteKey()))->horizontal()->multipart() !!}
            @include('post::_form')
        {!! form()->close() !!}
    </x-volt-panel>
</x-volt-app>
