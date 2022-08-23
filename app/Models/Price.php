<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Price
 *
 * @property int                             $id
 * @property int                             $product_id
 * @property string                          $value
 * @property string                          $currency
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Product $product
 * @method static \Database\Factories\PriceFactory            factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Price newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Price query()
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Price whereValue($value)
 * @mixin \Eloquent
 */
class Price extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'currency',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
