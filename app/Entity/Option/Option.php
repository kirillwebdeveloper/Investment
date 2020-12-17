<?php

namespace App\Entity\Option;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'slug',
        'value'
    ];
}
