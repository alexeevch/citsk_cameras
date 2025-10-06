<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property int         $id
 * @property string      $first_name
 * @property string      $last_name
 * @property string|null $middle_name
 * @property string      $email
 * @property string|null $phone
 * @property string      $password
 * @property bool        $is_blocked
 * @property string|null $remember_token
 * @property Carbon      $created_at
 * @property Carbon      $updated_at
 *
 * @property-read string $full_name
 *
 * @method static UserFactory factory($count = null, $state = [])
 */
class User extends Authenticatable
{
    /**
     * @use HasFactory<UserFactory>
     */

    use HasFactory, Notifiable, HasRoles, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'email',
        'phone',
        'password',
        'is_blocked',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_blocked' => 'boolean',
            'password'   => 'hashed',
        ];
    }

    /**
     * Get the user's full name.
     */
    public function getFullNameAttribute(): string
    {
        return trim($this->first_name.' '.($this->middle_name ? $this->middle_name.' ' : '').$this->last_name);
    }
}
