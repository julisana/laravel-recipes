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
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File as HttpFile;

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
    use SoftDeletes;
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
     * @return string
     */
    public function getExtension()
    {
        return HttpFile::extension( $this->path );
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param int          $orderNumber
     *
     * @return string
     */
    public static function createPhotoName( UploadedFile $uploadedFile, $orderNumber )
    {
        return self::fileName( $uploadedFile, 'photo-' . $orderNumber );
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param int          $orderNumber
     *
     * @return string
     */
    public static function createFileName( UploadedFile $uploadedFile, $orderNumber )
    {
        return self::fileName( $uploadedFile, 'file-' . $orderNumber );

    }

    /**
     * @param UploadedFile $uploadedFile
     * @param string       $fileName
     *
     * @return string
     */
    protected static function fileName( UploadedFile $uploadedFile, $fileName )
    {
        if ( $extension = $uploadedFile->guessExtension() ) {
            $extension = '.' . $extension;
        }
        $fileName .= $extension;

        return $fileName;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param int          $recipeId
     * @param int          $orderNumber
     *
     * @return false|string
     */
    public static function uploadPhoto( UploadedFile $uploadedFile, $recipeId, $orderNumber )
    {
        return $uploadedFile->storeAs(
            'files/recipe-' . $recipeId,
            self::createPhotoName( $uploadedFile, $orderNumber ),
            'public'
        );
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param int          $recipeId
     * @param int          $orderNumber
     *
     * @return false|string
     */
    public static function uploadFile( UploadedFile $uploadedFile, $recipeId, $orderNumber )
    {
        return $uploadedFile->storeAs(
            'files/recipe-' . $recipeId,
            self::createFileName( $uploadedFile, $orderNumber ),
            'public'
        );
    }
}
