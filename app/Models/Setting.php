<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'img',
        'address',
        'phone',
        'floor_plan',
        'facebook',
        'instagram',
        'linkedin',
        'x',
        'youtube',
        'flickr',
        'lat',
        'lang',
        'email'
    ];
}
