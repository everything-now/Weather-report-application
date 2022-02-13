<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;

class LoginControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_success_register_and_login()
    {
        $response = $this->post('/api/register', [
            'email' => 'test@mail.com',
            'password' => 'test_password',
        ]);

        $response->assertStatus(201);
        $this->assertEquals(User::count(), 1);

        $response = $this->post('/api/login', [
            'email' => 'test@mail.com',
            'password' => 'test_password',
        ]);

        $response->assertStatus(200);
    }

    public function test_fail_login()
    {
        $response = $this->post('/api/login', [
            'email' => 'wrong@mail.com',
            'password' => 'wrong_password',
        ]);

        $response->assertStatus(401);
    }
}
