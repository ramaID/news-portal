@php
    $query = 'SELECT id, name from topics order by name';
@endphp

{!! form()->dropdownDB('topic_id', $query, 'id', 'name')->label('Topic')->required() !!}
{!! form()->text('title')->label('Title')->required() !!}
{!! form()->redactor('summary')->label('Summary') !!}
{!! form()->redactor('body')->label('Body')->required() !!}
{!! form()->select('status', ['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived'])->label('Status')->required() !!}


{!!
    form()
        ->uploader('featured_image')
        ->extensions(['jpg', 'jpeg', 'png', 'gif'])
        ->fileMaxSize(2 * 1024 * 1024) // 2 MB
        ->label('Featured Image')
!!}

{!!
    form()->action([
        form()->submit('Simpan'),
        form()->link('Batal', route('modules::post.index'))
    ])
!!}
