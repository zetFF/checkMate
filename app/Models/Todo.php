<?php

// Mendefinisikan namespace untuk model Todo
namespace App\Models;

// Mengimpor Model dari Laravel
use Illuminate\Database\Eloquent\Model;

// Mendefinisikan class Todo yang meng-extend Model
class Todo extends Model
{
    // Mendefinisikan field yang bisa diisi (mass assignment)
    protected $fillable = [
        'name',
        'description',
        'priority',
        'due_date',
        'is_completed'
    ];

    // Mendefinisikan tipe data untuk field tertentu
    protected $casts = [
        'due_date' => 'datetime',
        'is_completed' => 'boolean'
    ];
}