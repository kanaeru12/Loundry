<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert(
            [
                'nama' => 'admin',
            ]
        );

        DB::table('role')->insert(
            [
                'nama' => 'owner',
            ]
        );

        DB::table('role')->insert(
            [
                'nama' => 'kasir',
            ]
        );
    }
}