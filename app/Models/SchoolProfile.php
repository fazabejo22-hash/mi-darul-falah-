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
        'extracurriculars',
        'facilities',
    ];

    protected $casts = [
        'extracurriculars' => 'array',
        'facilities' => 'array',
    ];
}
