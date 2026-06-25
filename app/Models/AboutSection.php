<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutSection extends Model
{
    protected $table = 'about_section';
    protected $guarded = [];

    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
