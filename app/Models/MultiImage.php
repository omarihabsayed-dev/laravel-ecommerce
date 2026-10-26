<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MultiImage extends Model
{
    protected $guarded = [];

    protected $casts = [
        'multi_image' => 'array',
    ];
}
