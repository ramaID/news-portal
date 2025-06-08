<?php

namespace Modules\Topic\Requests;

class Update extends Store
{
    public function authorize()
    {
        // Model di-resolve oleh route model binding
        return $this->user()->can('update', $this->route('topic'));
    }

    public function rules()
    {
        $topicId = $this->route('topic')->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:topics,slug,'.$topicId],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
