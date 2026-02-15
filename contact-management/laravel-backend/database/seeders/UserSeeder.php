<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'khannedy',
            'name' => 'Khannedy',
            'password' => 'rahasia123',
            'token' => Str::uuid()->toString()
        ]);
        User::create([
            'username' => 'khannedy2',
            'name' => 'Khannedy2',
            'password' => 'rahasia123456',
            'token' => Str::uuid()->toString()
        ]);
    }
}
