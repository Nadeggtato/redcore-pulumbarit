<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
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

        $superAdmin->assignRole($superAdminRole);
    }
}
