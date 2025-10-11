<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')->insert([
            'name' => 'Admin',
            'created_at' => Carbon::now(),
        ]);
        DB::table('user_roles')->insert([
            'name' => 'Provider',
            'created_at' => Carbon::now(),
        ]);
        DB::table('user_roles')->insert([
            'name' => 'Client',
            'created_at' => Carbon::now(),
        ]);
    }
}
