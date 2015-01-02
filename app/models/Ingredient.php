<?php

class Ingredient extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ingredients';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    protected $fillable = array(
        'recipe_id',    //recipe->id
        'quantity',
        'name',
        'notes',
    );

    public function recipe() {
        return $this->belongsTo('Recipe');
    }

}
