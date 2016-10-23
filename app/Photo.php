<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'title',
        'file'
    ];

    protected $visible = [
        'title',
        'file'
    ];
}
