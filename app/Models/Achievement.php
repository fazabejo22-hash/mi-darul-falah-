<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Achievement extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'achievement_date',
        'level',
        'recipient_name',
        'image',
        'is_published',
    ];

    protected $casts = [
        'achievement_date' => 'date',
        'is_published' => 'boolean',
    ];
}
