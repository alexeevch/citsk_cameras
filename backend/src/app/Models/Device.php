<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int            $id
 * @property string         $name
 * @property DeviceCategory $deviceCategory
 * @property Carbon         $created_at
 * @property Carbon         $updated_at
 */
class Device extends Model
{
    public function marker(): HasMany
    {
        return $this->hasMany(Marker::class);
    }

    public function deviceCategory(): BelongsTo
    {
        return $this->belongsTo(DeviceCategory::class);
    }
}
