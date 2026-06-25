<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroBlock extends Model
{
    protected $guarded = [];

    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }
}
