<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $guarded = [];

    protected $casts = [
        'published_at' => 'date',
        'is_published' => 'boolean',
    ];
}
