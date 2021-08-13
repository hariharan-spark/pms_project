<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;
use Illuminate\Support\Facades\DB;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['role' => 'Admin'],
            ['role' => 'Project Manager'],
            ['role' => 'Team Leader'],
            ['role' => 'Team Member'],
            ['role' => 'Guest']
        ]);
    }
}
