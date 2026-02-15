<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $contact = $user->contacts()->first();

        $contact->addresses()->create([
            'street' => 'jl. 123',
            'city' => 'cilegon',
            'province' => 'banten',
            'postal_code' => '123',
            'country' => 'indonesia',
            'contact_id' => $contact->id
        ]);
    }
}
