<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 11/13/17
 * Time: 7:36 PM
 */

namespace App\Models;

use Exception;
use Spatie\Tags\HasTags;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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
 * @property \Illuminate\Support\Carbon|null                                        $created_at
 * @property \Illuminate\Support\Carbon|null                                        $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Direction[]  $directions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Ingredient[] $ingredients
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\File[]       $photos
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\File[]       $files
 * @property \Illuminate\Database\Eloquent\Collection|\Spatie\Tags\Tag[]            $tags
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereCookTime( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereCreatedAt( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereDescription( $value )
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Recipe whereDifficulty( $value )
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Delete the model, and related models, from the database.
     *
     * @return bool|null
     * @throws Exception
     */
    public function delete()
    {
        $this->ingredients()->withTrashed()->forceDelete();
        $this->directions()->withTrashed()->forceDelete();
        $this->photos()->withTrashed()->forceDelete();

        return parent::delete();
    }

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany( File::class )
            ->where( 'type', '=', 'photo' )
            ->orderBy( 'order_number', 'asc' );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany( File::class )
            ->where( 'type', '=', 'file' )
            ->orderBy( 'order_number', 'asc' );
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

        $photos = [];
        $uploadedFiles = $request->file( 'photos' );
        foreach ( $request->get( 'photos', [] ) as $key => $row ) {
            //Set the order number value. Items should already be in the correct order, just need to add the value
            $row[ 'order_number' ] = $key + 1;

            $uploadedFile = array_get( $uploadedFiles, $key, '' );
            if ( array_has( $uploadedFile, 'photo' ) ) {
                if ( $uploadedFile[ 'photo' ] instanceof UploadedFile ) {
                    $item[ 'path' ] = File::uploadPhoto( $uploadedFile[ 'photo' ], $row->id, $row[ 'order_number' ] );
                }
                $photos[] = $row;
            }
        }
        $recipe->photos()->createMany( $photos );

        $files = [];
        $uploadedFiles = $request->file( 'files' );
        foreach ( $request->get( 'files', [] ) as $key => $row ) {
            //Set the order number value. Items should already be in the correct order, just need to add the value
            $row[ 'order_number' ] = $key + 1;

            $uploadedFile = array_get( $uploadedFiles, $key, '' );
            if ( array_has( $uploadedFile, 'file' ) ) {
                if ( $uploadedFile[ 'file' ] instanceof UploadedFile ) {
                    $item[ 'path' ] = File::uploadFile( $uploadedFile[ 'file' ], $row->id, $row[ 'order_number' ] );
                }
                $files[] = $row;
            }
        }
        $recipe->files()->createMany( $files );

        return redirect( $recipe->getUrl() );
    }

    /**
     * @param Request $request
     *
     * @throws Exception
     */
    public function updateItem( Request $request )
    {
        $fields = $request->except( '_token', 'ingredients', 'directions', 'photos', 'files', 'delete_ingredient', 'delete_direction', 'delete_photo', 'delete_file' );
        /** @var Recipe $recipe */
        foreach ( $fields as $key => $value ) {
            $this->{$key} = $value;
        }
        $this->save();

        $this->deleteIngredients( explode( ',', $request->get( 'delete_ingredient', '' ) ) )
            ->updateIngredients( $request->get( 'ingredients', [] ) )
            ->deleteDirections( explode( ',', $request->get( 'delete_direction', '' ) ) )
            ->updateDirections( $request->get( 'directions', [] ) )
            ->deletePhotos( explode( ',', $request->get( 'delete_photo', '' ) ) )
            ->updatePhotos( $request->get( 'photos', [] ), $request->file( 'photos', [] ) )
            ->deleteFiles( explode( ',', $request->get( 'delete_file', '' ) ) )
            ->updateFiles( $request->get( 'files', [] ), $request->file( 'files', [] ) );
    }

    /**
     * @param array $ids
     *
     * @return $this
     * @throws Exception
     */
    protected function deleteIngredients( array $ids )
    {
        if ( empty( $ids ) ) {
            return $this;
        }

        foreach ( $ids as $id ) {
            $item = $this->ingredients->keyBy( 'id' )->get( $id );
            if ( $item instanceof Ingredient ) {
                $item->delete();
            }
        }

        return $this;
    }

    /**
     * @param array $ids
     *
     * @return $this
     * @throws Exception
     */
    protected function deleteDirections( array $ids )
    {
        if ( empty( $ids ) ) {
            return $this;
        }

        foreach ( $ids as $id ) {
            $item = $this->directions->keyBy( 'id' )->get( $id );
            if ( $item instanceof Direction ) {
                $item->delete();
            }
        }

        return $this;
    }

    /**
     * @param array $ids
     *
     * @return $this
     * @throws Exception
     */
    protected function deletePhotos( array $ids )
    {
        if ( empty( $ids ) ) {
            return $this;
        }

        foreach ( $ids as $id ) {
            $item = $this->photos->keyBy( 'id' )->get( $id );
            if ( $item instanceof File ) {
                $item->delete();
            }
        }

        return $this;
    }

    /**
     * @param array $ids
     *
     * @return $this
     * @throws Exception
     */
    protected function deleteFiles( array $ids )
    {
        if ( empty( $ids ) ) {
            return $this;
        }

        foreach ( $ids as $id ) {
            $item = $this->files->keyBy( 'id' )->get( $id );
            if ( $item instanceof File ) {
                $item->delete();
            }
        }

        return $this;
    }

    /**
     * @param array $items
     *
     * @return $this
     */
    protected function updateIngredients( array $items )
    {
        $newItems = [];
        foreach ( $items as $item ) {
            if ( !isset( $item[ 'id' ] ) ) {
                $newItems[] = $item;
                continue;
            }

            //Update existing item
            $ingredient = $this->ingredients->keyBy( 'id' )->get( $item[ 'id' ] );
            foreach ( $item as $key => $value ) {
                $ingredient->{$key} = $value;
            }

            $ingredient->save();
        }

        //Create new items
        if ( !empty( $newItems ) ) {
            $this->ingredients()->createMany( $newItems );
        }

        return $this;
    }

    /**
     * @param array $items
     *
     * @return $this
     */
    protected function updateDirections( array $items )
    {
        $newItems = [];
        foreach ( $items as $item ) {
            if ( !isset( $item[ 'id' ] ) ) {
                $newItems[] = $item;
                continue;
            }

            //Update existing item
            $direction = $this->directions->keyBy( 'id' )->get( $item[ 'id' ] );
            foreach ( $item as $key => $value ) {
                $direction->{$key} = $value;
            }

            $direction->save();
        }

        //Create new items
        if ( !empty( $newItems ) ) {
            $this->directions()->createMany( $newItems );
        }

        return $this;
    }

    /**
     * @param array $items
     * @param array $files
     *
     * @return $this
     */
    protected function updatePhotos( array $items, array $files )
    {
        $newItems = [];
        foreach ( $items as $rowId => $item ) {
            if ( !isset( $item[ 'id' ] ) ) {
                $uploadedFile = array_get( $files, $rowId, '' );
                if ( array_has( $uploadedFile, 'photo' ) ) {
                    if ( $uploadedFile[ 'photo' ] instanceof UploadedFile ) {
                        $item[ 'path' ] = File::uploadPhoto( $uploadedFile[ 'photo' ], $this->id, $item[ 'order_number' ] );
                    }

                    $newItems[] = $item;
                }
                continue;
            }

            //Update existing item
            $photo = $this->photos->keyBy( 'id' )->get( $item[ 'id' ] );
            foreach ( $item as $key => $value ) {
                $photo->{$key} = $value;
            }

            $photo->save();
        }

        //Create new items
        if ( !empty( $newItems ) ) {
            $this->photos()->createMany( $newItems );
        }

        return $this;
    }

    /**
     * @param array $items
     * @param array $files
     *
     * @return $this
     */
    protected function updateFiles( array $items, array $files )
    {
        $newItems = [];
        foreach ( $items as $rowId => $item ) {
            if ( !isset( $item[ 'id' ] ) ) {
                $uploadedFile = array_get( $files, $rowId, '' );
                if ( array_has( $uploadedFile, 'file' ) ) {
                    if ( $uploadedFile[ 'file' ] instanceof UploadedFile ) {
                        $item[ 'path' ] = File::uploadFile( $uploadedFile[ 'file' ], $this->id, $item[ 'order_number' ] );
                    }

                    $newItems[] = $item;
                }
                continue;
            }

            //Update existing item
            $file = $this->files->keyBy( 'id' )->get( $item[ 'id' ] );
            foreach ( $item as $key => $value ) {
                $file->{$key} = $value;
            }

            $file->save();
        }

        //Create new items
        if ( !empty( $newItems ) ) {
            $this->files()->createMany( $newItems );
        }

        return $this;
    }
}
