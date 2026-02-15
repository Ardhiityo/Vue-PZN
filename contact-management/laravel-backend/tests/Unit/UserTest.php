<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Database\Seeders\DatabaseSeeder;

class UserTest extends TestCase
{
    public function testUserRegisterSuccess(): void
    {
        $this->post(route('register'), [
            'username' => 'khannedy',
            'name' => 'Khannedy',
            'password' => 'rahasia123'
        ])
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'username' => 'khannedy',
                    'name' => 'Khannedy'
                ]
            ]);
    }

    public function testUserRegisterFailed()
    {
        $this->post(route('register'), [
            'username' => '',
            'name' => '',
            'password' => ''
        ])
            ->assertStatus(400)
            ->assertJson([
                'username' => ['The username field is required.'],
                'name' => ['The name field is required.'],
                'password' => ['The password field is required.']
            ]);
    }

    public function testUserRegisterAlreadyRegistered()
    {
        $this->seed(DatabaseSeeder::class);

        $this->post(route('register'), [
            'username' => 'khannedy',
            'name' => 'Khannedy',
            'password' => 'rahasia123'
        ])
            ->assertStatus(400)
            ->assertJson([
                'username' => ['The username has already been taken.'],
            ]);
    }

    public function testUserLoginSuccess(): void
    {
        $this->seed(DatabaseSeeder::class);

        $response = $this->post(route('login'), [
            'username' => 'khannedy',
            'password' => 'rahasia123'
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'username' => 'khannedy',
                'name' => 'Khannedy'
            ]
        ]);

        self::assertNotNull($response->json('data.token'));
    }

    public function testUserLoginFailed(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->post(route('login'), [
            'username' => '',
            'password' => ''
        ])
            ->assertStatus(400)
            ->assertJson([
                'username' => ['The username field is required.'],
                'password' => ['The password field is required.']
            ]);
    }

    public function testUserLoginFailedWrongPassword(): void
    {
        $this->seed(DatabaseSeeder::class);

        $this->post(route('login'), [
            'username' => 'khannedy',
            'password' => 'hello123'
        ])
            ->assertStatus(400)
            ->assertJson([
                'username' => ['Username or password is wrong'],
            ]);
    }

    public function testCurrentUserSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $this->get(route('user.current'), ['Authorization' => $user->token])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'username' => $user->username,
                    'token' => $user->token
                ]
            ]);
    }

    public function testCurrentUserFailed()
    {
        $this->seed(DatabaseSeeder::class);

        $this->get(route('user.current'), ['Authorization' => 'salah'])
            ->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'token' => ['Unauthorized']
                ]
            ]);
    }

    public function testUpdateUserSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $this->patch(route('user.update'), [
            'name' => 'Budi Nugroho'
        ], ['Authorization' => $user->token])
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'name' => 'Budi Nugroho',
                ]
            ]);
    }

    public function testUpdateUserUnauthorized()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $this->patch(route('user.update'), [
            'name' => 'Budi Nugroho'
        ])
            ->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'token' => ['Unauthorized'],
                ]
            ]);
    }

    public function testUpdateUserFailedValidation()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $this->patch(route('user.update'), [
            'name' => 'Budi'
        ], ['Authorization' => $user->token])
            ->assertStatus(400)
            ->assertJson([
                'name' => ['The name field must be at least 8 characters.'],
            ]);
    }

    public function testUserLogoutSuccess()
    {
        $this->seed(DatabaseSeeder::class);

        $user = User::first();

        $this->delete(
            route('user.logout'),
            headers: ['Authorization' => $user->token]
        )->assertStatus(200)
            ->assertJson([
                'data' => true
            ]);
    }

    public function testUserLogoutUnauthorized()
    {
        $this->seed(DatabaseSeeder::class);

        $this->delete(
            route('user.logout'),
        )->assertStatus(401)
            ->assertJson([
                'errors' => [
                    'token' => ['Unauthorized']
                ]
            ]);
    }
}
