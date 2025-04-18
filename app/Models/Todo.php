<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    // dekalarasi table column
    protected $fillable = [
        'name',
        'description',
        'priority',
        'due_date',
        'is_completed'
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'is_completed' => 'boolean'
    ];
}
