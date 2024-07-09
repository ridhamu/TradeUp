<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    #register
    public function testRegisterSuccess()
    {
        $response = $this->post('/api/users', [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'contact' => '081361657304',
            'password' => 'rahasia',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'id' => true,
                'name' => 'John Doe',
                'email' => 'john@doe.com',
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@doe.com',
        ]);
    }

    public function testRegisterFail()
    {
        $response = $this->postJson('/api/users', [
            'name' => '',
            'email' => 'invalid-email',
            'contact' => '',
            'password' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'contact', 'password']);
    }

    public function testRegisterUserAlreadyExists()
    {
        // Create the first user
        User::create([
            'name' => 'Jane Doe',
            'email' => 'jane@doe.com',
            'contact' => '081361657305',
            'password' => bcrypt('rahasia'),
        ]);

        // Attempt to create another user with the same contact
        $response = $this->postJson('/api/users', [
            'name' => 'John Doe',
            'email' => 'john@doe.com',
            'contact' => '081361657305', // Duplicate contact
            'password' => 'rahasia',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['contact']);
    }

    #login
    public function testLoginSuccess()
    {
        $this->seed([UserSeeder::class]);

        $response = $this->postJson('/api/users/login', [
            'email' => 'test@test.com',
            'password' => 'test',
        ])->assertStatus(200)
            ->assertJsonStructure([
                'name',
                'email',
                'contact',
                'token',
            ]);
    }


    public function testLoginFail()
    {
        $this->seed([UserSeeder::class]);

        $this->postJson('/api/users/login', [
            'email' => 'test@test.com',
            'password' => 'wrong_password',
        ])->assertStatus(422)
            ->assertJson([
                'message' => 'email or password are incorrect.',
            ]);
    }
}
