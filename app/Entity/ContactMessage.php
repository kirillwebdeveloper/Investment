<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'radio_selected',
        'message',
        'is_new',
    ];
}
