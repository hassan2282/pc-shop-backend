<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $roles = [
            'Guest' => ['guest'],
            'Admin' => ['orders', 'tickets', 'products', 'articles',],
            'Vendor' => ['users', 'orders', 'tickets', 'products', 'articles', 'permissions'],
            'Owner' => ['users', 'orders', 'tickets', 'products', 'articles', 'permissions', 'superAdmin'],
        ];

        foreach ($roles as $roleName => $permissionNames) {
            $role = Role::create(['name' => $roleName]);
            foreach ($permissionNames as $permissionName) {
                $permission = Permission::where('name', $permissionName)->first();
                $permission->roles()->syncWithoutDetaching(['role_id' => $role->id]);
            };
        };
    }
}
