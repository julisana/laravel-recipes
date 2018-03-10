<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 11/13/17
 * Time: 7:36 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'description', 'source', 'source_url', 'notes', 'prep_time', 'cook_time', 'servings', 'serving_size',
        'created_by', 'updated_by',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ingredients()
    {
        return $this->hasMany( Ingredient::class )->orderBy( 'order_number', 'asc' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function directions()
    {
        return $this->hasMany( Direction::class )->orderBy( 'order_number', 'asc' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo( User::class );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function savedBy()
    {
        return $this->belongsToMany( User::class );
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return route( 'recipes.show', [ 'slug' => $this->getSlug(), 'id' => $this->id ] );
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return str_slug( $this->name );
    }
}
