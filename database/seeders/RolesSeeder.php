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
        $permissions = Permission::all();
        Role::factory()->count(20)->create()->each(function($role) use ($permissions){
            $randomPermissions = $permissions->random(rand(1,7))->pluck('id');
            $role->permissions()->attach($randomPermissions);
        });
    }
}
