<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int         $id
 * @property double      $latitude
 * @property double      $longitude
 * @property string|null $address
 * @property string|null $description
 * @property Device      $device
 * @property Carbon      $createdAt
 * @property Carbon      $updatedAt
 */
class Marker extends Model
{
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }
}
