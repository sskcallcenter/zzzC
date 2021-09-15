<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'textbox', 'textarea', 'radiobtn', 'select', 'checkbox',
    ];
}
