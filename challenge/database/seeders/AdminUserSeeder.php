<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Vinicius Kuwakino',
                'email' => 'vinicius@gmail.com',
                'password' => Hash::make('123mudar'),
            ],
            [
                'name' => 'Gon Freecss',
                'email' => 'gon@gmail.com',
                'password' => Hash::make('123mudar'),
            ],
            [
                'name' => 'Killua Zoldyck',
                'email' => 'killua@gmail.com',
                'password' => Hash::make('123mudar'),
            ],
        ]);
    }
}
