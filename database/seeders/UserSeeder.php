<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
            'email' => 'jess@laundry.com',
            'password' => Hash::make('bojes22'),
            'name' => 'Laundry Express',
            'role' => Role::Admin->value,
        ]);
        $user->save();
    }
}
