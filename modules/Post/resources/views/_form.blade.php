{!! form()->text('topic_id')->label('Topic Id')->required() !!}
{!! form()->text('created_by')->label('Created By')->required() !!}
{!! form()->text('title')->label('Title')->required() !!}
{!! form()->text('slug')->label('Slug')->required() !!}
{!! form()->textarea('summary')->label('Summary') !!}
{!! form()->textarea('body')->label('Body')->required() !!}
{!! form()->text('featured_image')->label('Featured Image') !!}
{!! form()->text('status')->label('Status')->required() !!}
{!! form()->datepicker('published_at')->label('Published At') !!}

{!!
    form()->action([
        form()->submit('Simpan'),
        form()->link('Batal', route('modules::post.index'))
    ])
!!}
