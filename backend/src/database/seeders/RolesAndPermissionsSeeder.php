<?php

namespace Database\Seeders;

use App\Constants\RolesConstants;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\{Permission, Role};
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $entities = [
            'user'       => 'пользователей',
            'role'       => 'ролей',
            'permission' => 'прав доступа',
            'marker'     => 'меток',
            'device'     => 'устройств',
        ];

        $actions = [
            'create' => 'Добавление',
            'read'   => 'Просмотр',
            'update' => 'Редактирование',
            'delete' => 'Удаление',
        ];

        foreach ($entities as $entity => $label) {
            foreach ($actions as $action => $verb) {
                Permission::updateOrCreate(
                    ['name' => "{$entity}.{$action}"],
                    ['description' => "{$verb} {$label}"]
                );
            }
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $root = Role::updateOrCreate(
            ['name' => RolesConstants::ROLE_ROOT],
            ['description' => 'Супер-пользователь']
        );
        $root->syncPermissions(Permission::all());

        $admin = Role::updateOrCreate(
            ['name' => RolesConstants::ROLE_ADMIN],
            ['description' => 'Администратор']
        );
        $admin->syncPermissions([
            'user.create',
            'user.read',
            'user.update',
            'user.delete',
            'marker.create',
            'marker.read',
            'marker.update',
            'marker.delete',
            'device.create',
            'device.read',
            'device.update',
            'device.delete',
        ]);

        $user = Role::updateOrCreate(
            ['name' => RolesConstants::ROLE_USER],
            ['description' => 'Пользователь']
        );
        $user->syncPermissions([
            'marker.create',
            'marker.read',
            'marker.update',
            'marker.delete',
        ]);

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
