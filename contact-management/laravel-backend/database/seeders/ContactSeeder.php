<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $user2 = User::where('name', 'khannedy2')->first();

        $user->contacts()->create([
            'first_name' => 'Jaka'
        ]);

        $user->contacts()->create([
            'first_name' => 'Juke',
            'phone' => '123'
        ]);

        $user->contacts()->create([
            'first_name' => 'Jeki',
            'email' => 'jeki@gmail.com',
        ]);

        $user->contacts()->create([
            'first_name' => 'Joki',
            'email' => 'joki@gmail.com',
        ]);

        $user2->contacts()->create([
            'first_name' => 'Jaki'
        ]);
    }
}
