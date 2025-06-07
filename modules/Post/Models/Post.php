<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;

class Post extends Model
{
    use AutoFilter, AutoSearch, AutoSort, HasFactory;

    protected $table = 'posts';

    protected $guarded = [];

    protected $searchableColumns = ["created_by", "title", "slug", "summary", "body", "featured_image", "status", "published_at",];

    protected static function newFactory()
    {
        return PostFactory::new();
    }
}
