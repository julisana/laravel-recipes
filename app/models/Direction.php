<?php

class Direction extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'directions';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array();

    protected $fillable = array(
        'recipe_id',    //recipe->id
        'order_number',
        'direction',
    );

    public function recipe() {
        return $this->belongsTo('Recipe');
    }

}
