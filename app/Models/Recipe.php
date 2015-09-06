<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $guarded = [];
    protected $table = [];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
