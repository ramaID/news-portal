{!! form()->text('name')->label('Name') !!}
{!! form()->textarea('description')->label('Description') !!}

{!!
    form()->action([
        form()->submit('Simpan'),
        form()->link('Batal', route('modules::topic.index'))
    ])
!!}
