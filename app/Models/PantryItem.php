<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PantryItem
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $type
 * @property int|null $count
 * @property \Illuminate\Support\Carbon|null $expiration_date
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PantryItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PantryItem newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PantryItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PantryItem query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PantryItem whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PantryItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PantryItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PantryItem whereExpirationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PantryItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PantryItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PantryItem whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PantryItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PantryItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PantryItem withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PantryItem withoutTrashed()
 * @mixin \Eloquent
 */
class PantryItem extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'type', 'count', 'expiration_date', 'notes',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expiration_date', 'created_at', 'updated_at', 'deleted_at',
    ];
}
