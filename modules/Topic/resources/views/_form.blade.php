	{!! form()->text('name')->label('Name') !!}
	{!! form()->text('slug')->label('Slug') !!}
	{!! form()->textarea('description')->label('Description') !!}

{!!
    form()->action([
        form()->submit('Simpan'),
        form()->link('Batal', route('modules::topic.index'))
    ])
!!}
