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

    public function recipe() {
        return $this->belongsTo('Recipe');
    }

}
