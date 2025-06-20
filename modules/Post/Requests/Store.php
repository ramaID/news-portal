<?php

namespace Modules\Post\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', \App\Models\Post::class);
    }

    protected function prepareForValidation()
    {
        if ($this->has('title') && ! $this->has('slug')) {
            $this->merge(['slug' => str($this->input('title'))->slug()->toString()]);
        }

        if (! $this->has('created_by')) {
            $this->merge(['created_by' => $this->user()->id]);
        }

        $this->mergeFeatureImage();
        $this->mergePublishedAt();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'topic_id' => ['required', 'exists:topics,id'],
            'created_by' => ['required', 'exists:users,id'],
            'title' => ['required', 'string'],
            'slug' => ['required', 'string', 'max:255', 'unique:posts,slug'],
            'summary' => ['nullable'],
            'body' => ['required', 'string'],
            'featured_image' => ['nullable'],
            'status' => ['required', 'in:published,draft,archived'],
            'published_at' => ['nullable', 'date', 'after_or_equal:today'],
        ];
    }

    protected function mergePublishedAt()
    {
        if ($this->input('status') === 'published' && ! $this->has('published_at')) {
            $this->merge(['published_at' => now()]);
        }
    }

    protected function mergeFeatureImage(): void
    {
        if ($this->has('_featured_image')) {
            $string = $this->input('_featured_image');
            $url = json_decode($string, true)[0]['file'] ?? null;

            $this->merge(['featured_image' => $url]);
        }

        $this->deleteOldFeatureImage();
    }

    protected function deleteOldFeatureImage(): void
    {
        $mediaID = null;

        // If the post already has a featured image, extract its ID
        if ($featureImage = $this->route('post')->featured_image ?? null) {
            $mediaID = $this->extractIdFromMediaUrl($featureImage);
        }

        if ($media = Media::query()->find($mediaID)) {
            $media->delete();
        }
    }

    protected function extractIdFromMediaUrl($url)
    {
        // Example implementation - adjust regex pattern based on your URL structure
        if (preg_match('#/storage/(\d+)/#', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
