<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    protected $fillable = [
        'name',
        'npsn',
        'nsm',
        'status',
        'accreditation',
        'established_year',
        'address',
        'whatsapp',
        'email',
        'headmaster',
        'vision',
        'mission',
        'history',
        'logo',
        'map_url',
        'extracurriculars',
        'facilities',
    ];

    protected $casts = [
        'extracurriculars' => 'array',
        'facilities' => 'array',
    ];
}
