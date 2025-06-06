<?php
namespace Modules\Topic\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class Store extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', \App\Models\Topic::class);
    }

    protected function prepareForValidation()
    {
        if ($this->has('name') && !$this->has('slug')) {
            $this->merge(['slug' => Str::slug($this->input('name'))]);
        }
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:topics,slug'],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }
}
