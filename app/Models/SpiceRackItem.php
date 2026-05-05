<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\SpiceRackItem
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $type
 * @property int|null $count
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpiceRackItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpiceRackItem newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SpiceRackItem onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpiceRackItem query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpiceRackItem whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpiceRackItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpiceRackItem whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpiceRackItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpiceRackItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpiceRackItem whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpiceRackItem whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SpiceRackItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SpiceRackItem withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SpiceRackItem withoutTrashed()
 * @mixin \Eloquent
 */
class SpiceRackItem extends Model
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
        'created_at', 'updated_at', 'deleted_at',
    ];
}
