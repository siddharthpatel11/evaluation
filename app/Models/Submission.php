<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['name', 'email', 'languages', 'marks_obtained', 'max_marks', 'description', 'images', 'issues'];

    protected $casts = [
        'languages' => 'array',
        'images' => 'array',
        'issues' => 'array',
    ];
}
