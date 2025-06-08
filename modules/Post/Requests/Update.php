<?php

namespace Modules\Post\Requests;

class Update extends Store
{
    public function authorize()
    {
        // Model di-resolve oleh route model binding
        return $this->user()->can('update', $this->route('post'));
    }

    public function rules()
    {
        $postID = $this->route('post')->id;
        $rules = parent::rules();
        $rules['slug'] = ['required', 'string', 'max:255', 'unique:posts,slug,'.$postID];

        return $rules;
    }
}
