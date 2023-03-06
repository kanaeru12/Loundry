<?php

use App\User;
use App\Outlet;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Outlet::create([
            'nama' => 'Laundry uhuy',
            'alamat' => 'jl jambu',
            'no_telp' => '0836544231',
        ]);

        // User::create([
        //     'name' => 'uhuy',
        //     'last_name' => 'Administrator',
        //     'email' => 'admin@mail.com',
        //     'role' => 'admin',
        //     'id_outlet' => '1',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        // ]);
        User::create([
            'name' => 'Punuk Laundry',
            'last_name' => 'Admin',
            'email' => 'yuhu@gmail.com',
            'role' => 'admin',
            'id_outlet' => '1',
            'email_verified_at' => now(),
            'password' => Hash::make('lembu123'), // password
        ]);
    }
}
