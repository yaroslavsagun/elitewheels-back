<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @method static Builder<static>|Brand newModelQuery()
 * @method static Builder<static>|Brand newQuery()
 * @method static Builder<static>|Brand query()
 *
 * @property int $id
 * @property string $name
 * @property string|null $logo
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @method static Builder<static>|Brand whereCreatedAt($value)
 * @method static Builder<static>|Brand whereId($value)
 * @method static Builder<static>|Brand whereLogo($value)
 * @method static Builder<static>|Brand whereName($value)
 * @method static Builder<static>|Brand whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 */
class Brand extends Model
{
    protected $fillable = ['name', 'logo'];

    public function getLogoAttribute(): ?string
    {
        return $this->getRawOriginal('logo') ? storage_path($this->getRawOriginal('logo')) : null;
    }
}
