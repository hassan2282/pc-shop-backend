<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::factory()->create([
            'name' => 'کاربر',
        ]);

        $this->call([
            PermissionSeeder::class,
            RolesSeeder::class,
            UsersSeeder::class,
            //CategorySeeder::class,
        ]);
    }
}
