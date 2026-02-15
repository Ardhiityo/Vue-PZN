<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Database\Seeders\DatabaseSeeder;

class AddressTest extends TestCase
{
    public function testAddressCreateSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $contact = $user->contacts()->first();

        $this->post(route(
            'address.create',
            ['contact' => $contact->id],
        ), [
            'street' => 'jl. 123',
            'city' => 'cilegon',
            'province' => 'banten',
            'postal_code' => '123',
            'country' => 'indonesia',
            'contact_id' => $contact->id
        ], ['Authorization' => $user->token])
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'street' => 'jl. 123',
                    'city' => 'cilegon',
                    'province' => 'banten',
                    'postal_code' => '123',
                    'country' => 'indonesia',
                    'contact_id' => $contact->id
                ]
            ]);
    }

    public function testAddressCreateFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $contact = $user->contacts()->first();

        $this->post(route(
            'address.create',
            ['contact' => $contact->id],
        ), [
            'street' => 'jl. 123',
            'province' => 'banten',
            'postal_code' => '123',
            'country' => 'indonesia',
            'contact_id' => $contact->id
        ], ['Authorization' => $user->token])
            ->assertStatus(400)
            ->assertJson([
                'city' => ['The city field is required.']
            ]);
    }

    public function testAddressListSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $contact = $user->contacts()->first();

        $response = $this->get(route(
            'address.index',
            ['contact' => $contact->id],
        ), ['Authorization' => $user->token])
            ->assertStatus(200);

        self::assertEquals(1, count($response->json('data')));
    }

    public function testAddressListFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $this->get(route(
            'address.index',
            ['contact' => 100],
        ), ['Authorization' => $user->token])
            ->assertStatus(404);
    }

    public function testAddressUpdateSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $contact = $user->contacts()->first();

        $address = $contact->addresses()->first();

        $this->patch(route(
            'address.update',
            [
                'contact' => $contact->id,
                'address' => $address->id
            ],
        ), [
            'street' => 'jl. 123',
            'province' => 'jabar',
            'postal_code' => '123',
            'country' => 'kamboja',
            'city' => 'bandung',
        ], ['Authorization' => $user->token])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'street' => 'jl. 123',
                    'province' => 'jabar',
                    'postal_code' => '123',
                    'country' => 'kamboja',
                    'city' => 'bandung',
                    'contact_id' => $contact->id
                ]
            ]);
    }

    public function testAddressUpdateFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $contact = $user->contacts()->first();

        $address = $contact->addresses()->first();

        $this->patch(route(
            'address.update',
            [
                'contact' => $contact->id,
                'address' => $address->id
            ],
        ), [
            'street' => 'jl. 123',
            'province' => 'jabar',
            'postal_code' => '123',
            'country' => 'kamboja'
        ], ['Authorization' => $user->token])
            ->assertStatus(400)
            ->assertJson([
                'city' => ['The city field is required.']
            ]);
    }

    public function testAddressDeleteSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $contact = $user->contacts()->first();

        $address = $contact->addresses()->first();

        $this->delete(route(
            'address.delete',
            [
                'contact' => $contact->id,
                'address' => $address->id
            ],
        ), headers: ['Authorization' => $user->token])
            ->assertStatus(200)
            ->assertJson([
                'data' => true
            ]);
    }

    public function testAddressDeleteFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $contact = $user->contacts()->first();

        $this->delete(route(
            'address.delete',
            [
                'contact' => $contact->id,
                'address' => 100
            ],
        ), headers: ['Authorization' => $user->token])
            ->assertStatus(404)
            ->assertJson([
                'errors' => [
                    'message' => ['Not found']
                ]
            ]);
    }

    public function testAddressGetByIdSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $contact = $user->contacts()->first();

        $address = $contact->addresses()->first();

        $this->get(route(
            'address.get',
            parameters: [
                'contact' => $contact->id,
                'address' => $address->id
            ],
        ), headers: ['Authorization' => $user->token])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'street' => $address->street,
                    'province' => $address->province,
                    'postal_code' => $address->postal_code,
                    'country' => $address->country,
                    'city' => $address->city,
                    'contact_id' => $contact->id
                ]
            ]);
    }

    public function testAddressGetByIdFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $contact = $user->contacts()->first();

        $address = $contact->addresses()->first();

        $response = $this->delete(route(
            'address.get',
            parameters: [
                'contact' => 100,
                'address' => 100
            ],
        ), headers: ['Authorization' => $user->token])
            ->assertStatus(404)
            ->assertJson([
                'errors' => [
                    'message' => ['Not found']
                ]
            ]);
    }
}
