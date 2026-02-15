<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;
use Database\Seeders\DatabaseSeeder;

class ContactTest extends TestCase
{
    public function testContactCreateSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $this->post(route('contact.create'), [
            'first_name' => 'Alvilurohman'
        ], ['Authorization' => $user->token])
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'first_name' => 'Alvilurohman',
                    'last_name' => null,
                    'email' => null,
                    'phone' => null
                ]
            ]);
    }

    public function testCreateContactFailedValidation()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $this->post(route('contact.create'), [
            'first_name' => null
        ], ['Authorization' => $user->token])
            ->assertStatus(400)
            ->assertJson([
                'first_name' => ['The first name field is required.']
            ]);
    }

    public function testCreateContactUnauthorized()
    {
        $this->seed(DatabaseSeeder::class);

        $this->post(route('contact.create'), [
            'first_name' => 'Alvilurohman'
        ],)
            ->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'token' => ['Unauthorized']
                ]
            ]);
    }

    public function testGetContactSuccess()
    {

        $this->seed(DatabaseSeeder::class);

        $user = User::first();
        $contact = $user->contacts()->first();

        $this->get(route(
            'contact.get',
            [
                'contact' => $contact->id
            ]
        ), [
            'Authorization' => $user->token
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'first_name' => $contact->first_name,
                    'last_name' => $contact->last_name,
                    'email' => $contact->email,
                    'phone' => $contact->phone
                ]
            ]);
    }

    public function testGetContactFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $this->get(route(
            'contact.get',
            [
                'contact' => 100
            ]
        ), [
            'Authorization' => $user->token
        ])->assertStatus(404)
            ->assertJson([
                'errors' => [
                    'message' => ['Contact not found']
                ]
            ]);
    }

    public function testGetContactOtherFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();
        $user2 = User::where('name', 'khannedy2')->first();

        $this->get(route(
            'contact.get',
            [
                'contact' => $user2->contacts()->first()
            ]
        ), [
            'Authorization' => $user->token
        ])->assertStatus(404)
            ->assertJson([
                'errors' => [
                    'message' => ['Contact not found']
                ]
            ]);
    }

    public function testUpdateContactSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();
        $contact = $user->contacts()->first();

        $this->patch(route(
            'contact.update',
            [
                'contact' => $contact->id
            ]
        ), [
            'first_name' => 'Budi Nugraha'
        ], [
            'Authorization' => $user->token
        ])->assertStatus(200)
            ->assertJson([
                'data' => [
                    'first_name' => 'Budi Nugraha'
                ]
            ]);
    }

    public function testUpdateContactFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();
        $contact = $user->contacts()->first();

        $this->patch(route(
            'contact.update',
            [
                'contact' => $contact->id
            ]
        ), [
            'first_name' => 'Budi'
        ], [
            'Authorization' => $user->token
        ])->assertStatus(400)
            ->assertJson([
                'first_name' => ['The first name field must be at least 8 characters.']
            ]);
    }

    public function testUpdateContactOtherFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $user2 = User::where('name', 'khannedy2')->first();

        $contact = $user2->contacts()->first();

        $this->patch(route(
            'contact.update',
            [
                'contact' => $contact->id
            ]
        ), [
            'first_name' => 'Budi Nugraha'
        ], [
            'Authorization' => $user->token
        ])->assertStatus(404)
            ->assertJson([
                'errors' => [
                    'message' => ['Contact not found']
                ]
            ]);
    }

    public function testDeleteContactSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $this->delete(route(
            'contact.delete',
            [
                'contact' => $user->contacts()->first()
            ],
        ), headers:[
            'Authorization' => $user->token
        ])->assertStatus(200)
            ->assertJson([
                'data' => true
            ]);
    }

    public function testDeleteContactFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $this->delete(route(
            'contact.delete',
            [
                'contact' => 100
            ],
        ), headers: [
            'Authorization' => $user->token
        ])->assertStatus(404)
            ->assertJson([
                'errors' => [
                    'message' => ['Contact not found']
                ]
            ]);
    }

    public function testDeleteContactOtherFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();
        $user2 = User::where('name', 'khannedy2')->first();
        $contact = $user2->contacts()->first();

        $this->delete(route(
            'contact.delete',
            [
                'contact' => $contact->id
            ],
        ), headers: [
            'Authorization' => $user->token
        ])->assertStatus(404)
            ->assertJson([
                'errors' => [
                    'message' => ['Contact not found']
                ]
            ]);
    }

    public function testSearchContactSuccess() {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

       $response = $this->get(route('contact.search', parameters: [
            'size' => 10,
            'page' => 1,
            'name' => '',
            'phone' => '',
            'email' => ''
        ]), headers: [
            'Authorization' => $user->token
        ]);

        $response->assertStatus(200);

        self::assertEquals(4,collect($response->json('data'))->count());
        self::assertNotNull($response->json('data'));
        self::assertNotNull($response->json('meta'));
        self::assertNotNull($response->json('links'));

    }

    public function testSearchContactWithKeywordNameSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $response = $this->get(route('contact.search', parameters: [
            'size' => 10,
            'page' => 1,
            'name' => 'juke',
            'phone' => '',
            'email' => ''
        ]), headers: [
            'Authorization' => $user->token
        ]);

        $response->assertStatus(200);

        self::assertEquals(1, collect($response->json('data'))->count());
        self::assertNotNull($response->json('data'));
        self::assertNotNull($response->json('meta'));
        self::assertNotNull($response->json('links'));
    }

    public function testSearchContactWithKeywordPhoneSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $response = $this->get(route('contact.search', parameters: [
            'size' => 10,
            'page' => 1,
            'name' => '',
            'phone' => '123',
            'email' => ''
        ]), headers: [
            'Authorization' => $user->token
        ]);

        $response->assertStatus(200);

        self::assertEquals(1, collect($response->json('data'))->count());
        self::assertNotNull($response->json('data'));
        self::assertNotNull($response->json('meta'));
        self::assertNotNull($response->json('links'));
    }

    public function testSearchContactWithKeywordEmailSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $response = $this->get(route('contact.search', parameters: [
            'size' => 10,
            'page' => 1,
            'name' => '',
            'phone' => '',
            'email' => 'jeki@gmail.com'
        ]), headers: [
            'Authorization' => $user->token
        ]);

        $response->assertStatus(200);

        Log::info(json_encode($response->json(), JSON_PRETTY_PRINT));

        self::assertEquals(1, collect($response->json('data'))->count());
        self::assertNotNull($response->json('data'));
        self::assertNotNull($response->json('meta'));
        self::assertNotNull($response->json('links'));
    }

    public function testSearchContactWithKeywordEmailAndNameSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $response = $this->get(route('contact.search', parameters: [
            'size' => 10,
            'page' => 1,
            'name' => 'Joki',
            'phone' => '',
            'email' => 'joki@gmail.com'
        ]), headers: [
            'Authorization' => $user->token
        ]);

        $response->assertStatus(200);

        self::assertEquals(1, collect($response->json('data'))->count());
        self::assertNotNull($response->json('data'));
        self::assertNotNull($response->json('meta'));
        self::assertNotNull($response->json('links'));
    }

    public function testSearchContactWithPageSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $response = $this->get(route('contact.search', parameters: [
            'size' => 1,
            'page' => 2,
            'name' => 'Joki',
            'phone' => '',
            'email' => 'joki@gmail.com'
        ]), headers: [
            'Authorization' => $user->token
        ]);

        $response->assertStatus(200);

        self::assertEquals(2, $response->json('meta.current_page'));
    }
}
