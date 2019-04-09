<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 11/13/17
 * Time: 7:36 PM
 */

namespace App\Models;

use Spatie\Tags\HasTags;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Recipe
 *
 * @property int                                                                    $id
 * @property string|null                                                            $name
 * @property string|null                                                            $difficulty
 * @property string|null                                                            $description
 * @property string|null                                                            $source
 * @property string|null                                                            $source_url
 * @property string|null                                                            $notes
 * @property CarbonInterval                                                         $prep_time
 * @property CarbonInterval                                                         $cook_time
 * @property int|null                                                               $servings
 * @property string|null                                                            $serving_size
 * @property array|null                                                             $files
 * @property \Illuminate\Support\Carbon|null                                        $created_at
 * @property \Illuminate\Support\Carbon|null                                        $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Direction[]  $directions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ingredient[] $ingredients
 * @property \Illuminate\Database\Eloquent\Collection|\Spatie\Tags\Tag[]            $tags
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereCookTime( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereCreatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereDescription( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereDifficulty( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereFiles( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereId( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereName( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereNotes( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe wherePrepTime( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereServingSize( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereServings( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereSource( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereSourceUrl( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereUpdatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe withAllTags( $tags, $type = null )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe withAllTagsOfAnyType( $tags )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe withAnyTags( $tags, $type = null )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe withAnyTagsOfAnyType( $tags )
 * @mixin \Eloquent
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
        'serving_size', 'files', 'created_by', 'updated_by',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'files' => 'array',
    ];

    /**
     * @var File[]|\Illuminate\Database\Eloquent\Collection
     */
    protected $photos;

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
     * @return File[]|\Illuminate\Database\Eloquent\Collection
     */
    public function photos()
    {
        if ( !empty( $photos ) ) {
            return $this->photos;
        }

        return $this->photos = File::whereIn( 'id', $this->files )->get();
    }

    /**
     *
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

    /**
     * Cast the prep_time value as a CarbonInterval
     *
     * @param $value
     *
     * @return CarbonInterval
     */
    public function getPrepTimeAttribute( $value )
    {
        return CarbonInterval::minutes( $value )->cascade();
    }

    /**
     * Cast the cook_time value as a CarbonInterval
     *
     * @param $value
     *
     * @return CarbonInterval
     */
    public function getCookTimeAttribute( $value )
    {
        return CarbonInterval::minutes( $value )->cascade();
    }

    /**
     * Generate the Total time for a recipe and return it as a CarbonInterval
     *
     * @return CarbonInterval
     */
    public function getTotalTime()
    {
        $totalTime = clone $this->getAttribute( 'prep_time' );

        return $totalTime->add( $this->getAttribute( 'cook_time' ) );
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Redirector
     */
    public static function createNew( Request $request )
    {
        /** @var Recipe $recipe */
        $recipe = self::create(
            $request->except( '_token', 'ingredients', 'description', 'photos' )
        );

        $ingredients = [];
        foreach ( $request->get( 'ingredients', [] ) as $key => $row ) {
            //Set the order number value. Items should already be in the correct order, just need to add the value
            $row[ 'order_number' ] = $key + 1;
            $ingredients[] = $row;
        }
        $recipe->ingredients()->createMany( $ingredients );

        $directions = [];
        foreach ( $request->get( 'directions', [] ) as $key => $row ) {
            //Set the order number value. Items should already be in the correct order, just need to add the value
            $row[ 'order_number' ] = $key + 1;
            $directions[] = $row;
        }
        $recipe->directions()->createMany( $directions );

        return redirect( $recipe->getUrl() );
    }
}
