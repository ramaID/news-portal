<?php

namespace Modules\Post\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'topic_id' => ['required'],
            'created_by' => ['required'],
            'title' => ['required'],
            'slug' => ['required'],
            'summary' => [''],
            'body' => ['required'],
            'featured_image' => [''],
            'status' => ['required'],
            'published_at' => [''],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
