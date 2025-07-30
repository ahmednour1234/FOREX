<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'name',
        'description',
        'number',
        'img',
        'active',
    ];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'active' => 'boolean',
    ];
}
