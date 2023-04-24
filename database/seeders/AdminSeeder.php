<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\str;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::firstOrCreate([
            'id' => 1,
            'name' => '管理人',
            'role' => 'admin',
            'email' => 'admin@test',
            'email_verified_at' => now(),
            'password' => Hash::make('hogehoge'),
            'remember_token' => Str::random(10),
        ]);
    }
}
