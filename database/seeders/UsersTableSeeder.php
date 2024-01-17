<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nama' => 'Admin',
            'role' => 'admin',
            'password' => Hash::make('adminpassword'),
            'alamat' => 'Admin Address',
            'no_hp' => '0821313131',
            'no_sim' => 'admin123',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
