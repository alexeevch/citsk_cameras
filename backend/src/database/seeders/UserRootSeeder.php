<?php

namespace Database\Seeders;

use App\Constants\RolesConstants;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRootSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => env('USER_ROOT_EMAIL')],
            [
                'email'      => env('USER_ROOT_EMAIL'),
                'password'   => Hash::make(env('USER_ROOT_PASSWORD')),
                'last_name'  => env('USER_ROOT_LAST_NAME'),
                'first_name' => env('USER_ROOT_FIRST_NAME'),
                'is_blocked' => false
            ]);

        $user->assignRole(RolesConstants::ROLE_ROOT);
    }
}
