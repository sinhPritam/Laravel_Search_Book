<?php

namespace Database\Seeders;

use App\Models\RoleHasPermission;
use App\Models\UserHasRole;
use Illuminate\Database\Seeder;

class RoleHasPermissionSeeder extends Seeder
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
                "permission_id" => 1,
                "role_id" => 1,
            ]
        ];
        RoleHasPermission::insert($data);
    }
}
