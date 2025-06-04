<?php
// app/Models/Recipe.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'ingredients',
        'instructions',
        'metadata',
        'status',
        'user_id', 
    ];

    protected $casts = [
        'ingredients' => 'array',
        'instructions' => 'array',
        'metadata' => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}

