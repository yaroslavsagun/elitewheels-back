<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * @property-read Brand|null $brand
 * @property-read Collection<int, CarImage> $images
 * @property-read int|null $images_count
 * @property-read CarImage|null $mainImage
 * @property-read Type|null $type
 * @property-read User|null $user
 *
 * @method static Builder<static>|Car newModelQuery()
 * @method static Builder<static>|Car newQuery()
 * @method static Builder<static>|Car query()
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property int $brand_id
 * @property int $type_id
 * @property int $price
 * @property string $color
 * @property string|null $description
 * @property string|null $engine
 * @property float|null $time_to_100
 * @property int|null $max_speed
 * @property int|null $max_power
 * @property int|null $power_per_liter
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder<static>|Car whereBrandId($value)
 * @method static Builder<static>|Car whereColor($value)
 * @method static Builder<static>|Car whereCreatedAt($value)
 * @method static Builder<static>|Car whereDescription($value)
 * @method static Builder<static>|Car whereId($value)
 * @method static Builder<static>|Car whereIsPopular($value)
 * @method static Builder<static>|Car whereName($value)
 * @method static Builder<static>|Car wherePrice($value)
 * @method static Builder<static>|Car whereTypeId($value)
 * @method static Builder<static>|Car whereUpdatedAt($value)
 * @method static Builder<static>|Car whereUserId($value)
 *
 */
class Car extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'brand_id',
        'type_id',
        'price',
        'color',
        'description',
        'engine',
        'time_to_100',
        'max_speed',
        'max_power',
        'power_per_liter',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(CarImage::class);
    }

    public function mainImage(): HasOne
    {
        return $this->hasOne(CarImage::class)->where('is_main', true);
    }
}
