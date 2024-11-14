<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property-read Car|null $car
 *
 * @method static Builder<static>|CarImage newModelQuery()
 * @method static Builder<static>|CarImage newQuery()
 * @method static Builder<static>|CarImage query()
 *
 * @property int $id
 * @property int $car_id
 * @property string $path
 * @property int $is_main
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder<static>|CarImage whereCarId($value)
 * @method static Builder<static>|CarImage whereCreatedAt($value)
 * @method static Builder<static>|CarImage whereId($value)
 * @method static Builder<static>|CarImage whereIsMain($value)
 * @method static Builder<static>|CarImage wherePath($value)
 * @method static Builder<static>|CarImage whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class CarImage extends Model
{
    protected $fillable = ['car_id', 'path', 'is_main'];

    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }
}
