<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'photoshopbaz98',
            'first_name' => 'سید حسن',
            'last_name' => 'تقوی',
            'phone' => '09170249855',
            'email' => 'taghavey.hassan@gmail.com',
            'status' => true,
            'role_id' => 2,
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => Str::random(10),
        ]);
        User::factory()->count(20)->create();
    }
}
