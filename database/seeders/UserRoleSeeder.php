<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')->insert([
            'name' => 'Admin'
        ]);
        DB::table('user_roles')->insert([
            'name' => 'Provider'
        ]);
        DB::table('user_roles')->insert([
            'name' => 'Client'
        ]);
    }
}
