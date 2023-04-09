<?php

namespace Database\Seeders;

use App\Models\UserHasRole;
use Illuminate\Database\Seeder;

class UserHasRoleSeeder extends Seeder
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
                "user_id" => 1,
                "role_id" => 1,
            ],
            [
                "user_id" => 2,
                "role_id" => 2,
            ]
        ];
        UserHasRole::insert($data);
    }
}
