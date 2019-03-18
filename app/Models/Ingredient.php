<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 11/13/17
 * Time: 7:35 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ingredient
 *
 * @property-read \App\Models\Recipe $recipe
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient query()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $recipe_id
 * @property int $order_number
 * @property string|null $name
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ingredient whereUpdatedAt($value)
 */
class Ingredient extends Model
{
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
