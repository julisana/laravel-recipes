<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    protected $fillable = array(
        'username',
        'password',
        'email',
        'first_name',
        'last_name',
        'active',
        'last_login',
    );

    public function getAuthIdentifier() {
        return $this->getKey();
    }

    public function recipesCreated() {
        return Recipe::where('created_by', '=', $this->id);
    }

    public function recipesUpdated() {
        return Recipe::where('updated_by', '=', $this->id);
    }

}
