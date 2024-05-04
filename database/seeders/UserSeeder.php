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
                'name' => 'superadmin',
                'password' => Hash::make('superadmin'),
                'email' => 'superadmin@admin.com',
                'roles' => 'superadmin'
            ],
            [
                'name' => 'admin',
                'password' => Hash::make('admin'),
                'email' => 'admin@admin.com',
                'roles' => 'admin'
            ],
            [
                'name' => 'admin',
                'password' => Hash::make('admin'),
                'email' => 'admin@admin.com',
                'roles' => 'superadmin'
            ],
            [
                'name' => 'anto',
                'password' => Hash::make('anto'),
                'email' => 'anto@anto.com',
                'roles' => 'admin'
            ],
            [
                'name' => 'dini',
                'password' => Hash::make('dini'),
                'email' => 'dini@dini.com',
                'roles' => 'admin'
            ],
            [
                'name' => 'riza',
                'password' => Hash::make('riza'),
                'email' => 'riza@riza.com',
                'roles' => 'admin'
            ],
        ]);
    }
}
