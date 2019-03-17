<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 11/13/17
 * Time: 7:33 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Models\Direction
 *
 * @property-read \App\Models\Recipe $recipe
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction query()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $recipe_id
 * @property int $order_number
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Direction whereUpdatedAt($value)
 */
class Direction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recipe_id', 'order_number', 'name',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo( Recipe::class );
    }
}
