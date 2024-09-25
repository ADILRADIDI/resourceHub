<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginNotification;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\ValidationException;

class AuthControllerTest extends TestCase
{
    use WithFaker;

    public function test_register()
    {
        Mail::fake();

        // Generate fake data
        $password = $this->faker->password(8);
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $password,
            'password_confirmation' => $password,
        ];

        // Send POST request to register endpoint
        $response = $this->postJson('/api/register', $data);

        // Assert that the response status is 200 (success)
        $response->assertStatus(200);

        // Assert that the user was created in the database
        $this->assertDatabaseHas('users', ['email' => $data['email']]);

        // Assert that the response contains the expected data
        $response->assertJsonStructure([
            'message',
            'token',
            'roles',
            'permissions',
        ]);

        // Assert that the user has the 'user' role
        $user = User::where('email', $data['email'])->first();
        $this->assertTrue($user->hasRole('user'));
    }

    public function test_login()
    {
        Mail::fake();

        // Create a user manually
        $password = $this->faker->password(8);
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make($password),
        ]);

        // Assign a role to the user
        $role = Role::firstOrCreate(['name' => 'user']);
        $user->assignRole($role);

        // Send POST request to login endpoint
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        // Assert that the response status is 200 (success)
        $response->assertStatus(200);

        // Assert that the response contains the expected data
        $response->assertJsonStructure([
            'token',
            'roles',
            'permissions',
        ]);

        // Assert that the email was sent
        Mail::assertSent(LoginNotification::class, function ($mail) use ($user) {
            return $mail->hasTo($user->email);
        });
    }

    public function test_login_fails_with_invalid_credentials()
    {
        // Create a user manually
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('valid_password'),
        ]);

        // Send POST request to login endpoint with invalid password
        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'invalid_password',
        ]);

        // Assert that the response status is 422 (validation error)
        $response->assertStatus(422);

        // Assert that the response contains the expected error message
        $response->assertJsonValidationErrors(['email']);
    }

    public function test_logout()
    {
        // Create a user manually
        $password = $this->faker->password(8);
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make($password),
        ]);

        // Generate a token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Set the token in the Authorization header
        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->postJson('/api/logout');

        // Assert that the response status is 200 (success)
        $response->assertStatus(200);

        // Assert that the token was revoked
        $this->assertDatabaseMissing('personal_access_tokens', [
            'tokenable_id' => $user->id,
            'token' => hash('sha256', explode('|', $token)[1]),
        ]);
    }

    public function test_user_info()
    {
        // Create a user manually
        $password = $this->faker->password(8);
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make($password),
        ]);

        // Generate a token for the user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Set the token in the Authorization header and send GET request to user endpoint
        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->getJson('/api/user');

        // Assert that the response status is 200 (success)
        $response->assertStatus(200);

        // Assert that the response contains the user's data
        $response->assertJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
