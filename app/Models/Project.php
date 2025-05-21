<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'projectName',
        'projectSummary',
        'projectDescription',
        'projectURL',
        'mainImagePath',
        'imagePaths',
    ];

    protected $casts = [
        'imagePaths' => 'array', // allows easy access as an array
    ];
}
