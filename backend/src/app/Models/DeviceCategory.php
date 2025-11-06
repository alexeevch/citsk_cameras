<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * @property int         $id
 * @property string      $name
 * @property string      $label
 * @property string|null $description
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 *
 */
class DeviceCategory extends Model
{
    public function device(): HasMany
    {
        return $this->hasMany(Device::class);
    }
}
