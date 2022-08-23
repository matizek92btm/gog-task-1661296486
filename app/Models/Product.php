<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Product
 *
 * @property        int                                           $id
 * @property        string                                        $name
 * @property        \Illuminate\Support\Carbon|null               $created_at
 * @property        \Illuminate\Support\Carbon|null               $updated_at
 * @property        \Illuminate\Support\Carbon|null               $deleted_at
 * @method   static \Database\Factories\ProductFactory            factory(...$parameters)
 * @method   static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method   static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method   static \Illuminate\Database\Query\Builder|Product    onlyTrashed()
 * @method   static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method   static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|Product whereDeletedAt($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method   static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 * @method   static \Illuminate\Database\Query\Builder|Product    withTrashed()
 * @method   static \Illuminate\Database\Query\Builder|Product    withoutTrashed()
 * @mixin \Eloquent
 */
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];
}
