<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 11/13/17
 * Time: 7:33 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Direction
 *
 * @property int $id
 * @property int|null $recipe_id
 * @property int $order_number
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Recipe|null $recipe
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Direction extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recipe_id', 'order_number', 'name', 'notes',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at'
    ];

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = [
        'recipe'
    ];

    /**
     * @var File[]|\Illuminate\Database\Eloquent\Collection
     */
    protected $photos;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo( Recipe::class );
    }
}
