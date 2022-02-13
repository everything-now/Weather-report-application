<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Models\User;

class ReportControllerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_unauthenticated_access()
    {
        $response = $this->json('GET', '/api/weather/report/pdf');

        $response->assertStatus(401);
        $this->assertEquals($response->getData()->message, 'Unauthenticated.');
    }

    private function getUserBearerToken()
    {
        $response = $this->post('/api/register', [
            'email' => 'test@mail.com',
            'password' => 'test_password',
        ]);

        return $response->getData()->token;
    }
}
