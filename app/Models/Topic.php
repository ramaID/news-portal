<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravolt\Suitable\AutoFilter;
use Laravolt\Suitable\AutoSearch;
use Laravolt\Suitable\AutoSort;

class Topic extends Model
{
    use HasUlids;

    use SoftDeletes;

    use AutoSearch, AutoSort, AutoFilter;

    protected $guarded = [];

    protected $searchableColumns = ["ulid", "name", "slug", "description",];
}
