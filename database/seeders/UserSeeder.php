<?php

namespace Database\Seeders;

use App\Models\UserHasRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$75HHVMNRJB7t4lgIg3.bnejL1sY4doym6WBJ4ejJqDEriVqVk9Q2q', // Test105*
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Test User',
                'email' => 'test@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$75HHVMNRJB7t4lgIg3.bnejL1sY4doym6WBJ4ejJqDEriVqVk9Q2q', // Test105*
                'remember_token' => Str::random(10),
            ],
        ];
        UserHasRole::insert($data);
    }
}
