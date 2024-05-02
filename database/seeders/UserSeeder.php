<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'password' => Hash::make('admin'),
                'email' => 'admin@admin.com'
            ],
            [
                'name' => 'anto',
                'password' => Hash::make('anto'),
                'email' => 'anto@anto.com'
            ],
            [
                'name' => 'dini',
                'password' => Hash::make('dini'),
                'email' => 'dini@dini.com'
            ],
            [
                'name' => 'riza',
                'password' => Hash::make('riza'),
                'email' => 'riza@riza.com'
            ],
        ]);
    }
}
