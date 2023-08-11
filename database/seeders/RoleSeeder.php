<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Enums\RoleEnum;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate([
            'name' => RoleEnum::SUPERADMIN,
        ], [
            'name' => RoleEnum::SUPERADMIN,
            'guard_name' => 'web'
        ]);

        Role::firstOrCreate([
            'name' => RoleEnum::ADMINISTRATOR,
        ], [
            'name' => RoleEnum::ADMINISTRATOR,
            'guard_name' => 'web'
        ]);
    }
}
