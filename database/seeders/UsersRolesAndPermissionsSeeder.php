<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UsersRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var User $superAdmin */
        $superAdmin = User::query()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('hello123'),
        ]);

        /** @var Role $superAdminRole */
        $superAdminRole = Role::create([
            'name' => Role::SUPER_ADMIN,
            'description' => 'Has access to everything',
            'guard_name' => 'web',
        ]);

        /** @var Role $admin */
        $admin = Role::create([
            'name' => Role::ADMIN,
            'description' => 'Limited permissions',
            'guard_name' => 'web',
        ]);

        $superAdmin->assignRole($superAdminRole);
        $this->seedPermissions();

        $adminPermissions = [
            'view any user',
            'view user',
            'create user',
        ];

        foreach ($adminPermissions as $permission) {
            $admin->givePermissionTo($permission);
        }
    }

    private function seedPermissions()
    {
        $userPermissions = [
            'view any user',
            'view user',
            'create user',
            'update user',
            'delete user',
        ];

        foreach ($userPermissions as $permission) {
            Permission::query()->create([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        $rolePermissions = [
            'view any role',
            'view role',
            'create role',
            'update role',
            'delete role',
        ];

        foreach ($rolePermissions as $permission) {
            Permission::query()->create([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
}
