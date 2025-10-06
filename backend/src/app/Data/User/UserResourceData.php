<?php

namespace App\Data\User;

use App\Models\User as UserModel;
use Illuminate\Support\Carbon;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\CamelCaseMapper;

#[MapName(CamelCaseMapper::class)]
class UserResourceData extends Data
{
    public function __construct(
        public int $id,
        public string $firstName,
        public string $lastName,
        public ?string $middleName,
        public string $email,
        public ?string $phone,
        public bool $isBlocked,
        public string $fullName,
        /** @var list<string> */
        public array $roles,
        /** @var list<string> */
        public array $permissions,
        public Carbon $createdAt,
        public Carbon $updatedAt,
    ) {
    }

    public static function fromModel(UserModel $user): self
    {
        return new self(
            id: $user->id,
            firstName: $user->first_name,
            lastName: $user->last_name,
            middleName: $user->middle_name,
            email: $user->email,
            phone: $user->phone,
            isBlocked: $user->is_blocked,
            fullName: $user->full_name,
            roles: $user->roles->pluck('name')->values()->all(),
            permissions: $user->getAllPermissions()->pluck('name')->values()->all(),
            createdAt: $user->created_at,
            updatedAt: $user->updated_at,
        );
    }
}
