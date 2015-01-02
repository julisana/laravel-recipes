<?php

class Recipe extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'recipes';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    protected $fillable = array(
        'name',
        'description',
        'source',
        'source_url',
        'notes',
        'prep_time',    //seconds
        'cook_time',    //seconds
        'created_by',   //user->id
        'updated_by',   //user->id
    );

    public function ingredients() {
        return $this->hasMany('Ingredient');
    }

    public function directions() {
        return $this->hasMany('Direction');
    }

    public function createdBy() {
        return User::where('id', '=', $this->created_by)->first();
    }

    public function updatedBy() {
        return User::where('id', '=', $this->updated_by)->first();
    }

}
