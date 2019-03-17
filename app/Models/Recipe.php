<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 11/13/17
 * Time: 7:36 PM
 */

namespace App\Models;

use Spatie\Tags\HasTags;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Recipe
 *
 * @property-read \App\Models\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Direction[] $directions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ingredient[] $ingredients
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $savedBy
 * @property \Illuminate\Database\Eloquent\Collection|\Spatie\Tags\Tag[] $tags
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe withAllTags($tags, $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe withAllTagsOfAnyType($tags)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe withAnyTags($tags, $type = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe withAnyTagsOfAnyType($tags)
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $name
 * @property string|null $difficulty
 * @property string|null $description
 * @property string|null $source
 * @property string|null $source_url
 * @property string|null $notes
 * @property int|null $prep_time
 * @property int|null $cook_time
 * @property int|null $servings
 * @property string|null $serving_size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereCookTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereDifficulty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe wherePrepTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereServingSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereServings($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereSourceUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereUpdatedAt($value)
 */
class Recipe extends Model
{
    use HasTags;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'difficulty', 'description', 'source', 'source_url', 'notes', 'prep_time', 'cook_time', 'servings',
        'serving_size', 'created_by', 'updated_by',
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
