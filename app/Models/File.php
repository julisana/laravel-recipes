<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 03/31/19
 * Time: 8:46 PM
 */

namespace App\Models;

use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\File
 *
 * @property int $id
 * @property int|null $recipe_id
 * @property int $order_number
 * @property string $type
 * @property string $path
 * @property string $caption
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Recipe|null $recipe
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereRecipeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\File whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'recipe_id', 'order_number', 'type', 'path', 'caption',
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
        'recipe',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function recipe()
    {
        return $this->belongsTo( Recipe::class );
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param int          $orderNumber
     *
     * @return string
     */
    protected function createRecipePhotoName( UploadedFile $uploadedFile, $orderNumber )
    {
        $fileName = 'recipe-' . ( $orderNumber + 1 );
        if ( $extension = $uploadedFile->guessExtension() ) {
            $extension = '.' . $extension;
        }
        $fileName .= $extension;

        return $fileName;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param string       $type
     * @param int          $recipeId
     * @param string       $fileName
     * @param string       $caption
     *
     * @return File
     */
    protected function uploadAndCreate( UploadedFile $uploadedFile, $type, $recipeId, $fileName, $caption = '' )
    {
        /** @var UploadedFile $uploadedFile */
        $filePath = $uploadedFile->storeAs( 'photos/recipe-' . $recipeId, $fileName, 'public' );

        return $this->create( [
            'type' => $type,
            'path' => $filePath,
            'caption' => $caption,
        ] );
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param int          $recipeId
     * @param int          $orderNumber
     *
     * @return File
     */
    public function uploadAndCreateRecipePhoto( UploadedFile $uploadedFile, $recipeId, $orderNumber )
    {
        $fileName = $this->createRecipePhotoName( $uploadedFile, $orderNumber );

        return $this->uploadAndCreate( $uploadedFile, 'photo', $recipeId, $fileName );
    }
}
