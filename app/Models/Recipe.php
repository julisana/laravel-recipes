<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'recipes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'source',
        'source_url',
        'notes',
        'prep_time',
        'cook_time',
        'servings',
        'serving_size',
        'created_by',
        'updated_by',
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
    public function ingredients()
    {
        return $this->hasMany('App\Models\Ingredient');
    }

    public function directions()
    {
        return $this->hasMany('App\Models\Direction');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\User');
    }
}
