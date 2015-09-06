<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'directions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recipe_id',
        'order_number',
        'direction',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    //Relationships
    public function recipe()
    {
        return $this->belongsTo('App\Models\Recipe', 'id', 'recipe_id');
    }
}
