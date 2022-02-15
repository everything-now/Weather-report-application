<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Http\Controllers\Api\ReportController;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use App\Models\User;
use Laravel\Passport\Passport;

class ReportControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected $user;

    protected function setUp() : void
    {
        parent::setUp();

        $mock = new MockHandler([
            new Response(200, [], $this->getMetarData())
        ]);

        $client = new Client(['handler' => HandlerStack::create($mock)]);

        app()->bind(ReportController::class, function () use ($client) {
            return new ReportController($client);
        });

        $this->user = User::factory()->create();
    }

    public function test_get_pdf()
    {
        Passport::actingAs($this->user);

        $response = $this->json('GET', '/api/weather/report/pdf', [
            'airports' => ['LEIB']
        ]);

        $response->assertStatus(200);
        $this->assertEquals($response->headers->get('content-type'), 'application/pdf');
    }

    public function test_get_html()
    {
        Passport::actingAs($this->user);

        $response = $this->json('GET', '/api/weather/report/html', [
            'airports' => ['LEIB']
        ]);

        $response->assertStatus(200);
        $this->assertStringContainsString('text/html', $response->headers->get('content-type'));
    }

    public function test_get_json()
    {
        Passport::actingAs($this->user);

        $response = $this->json('GET', '/api/weather/report/json', [
            'airports' => ['LEIB']
        ]);

        $response->assertStatus(200);
        $this->assertEquals($response->headers->get('content-type'), 'application/json');
    }

    public function test_get_text()
    {
        Passport::actingAs($this->user);

        $response = $this->json('GET', '/api/weather/report/text', [
            'airports' => ['LEIB']
        ]);

        $response->assertStatus(200);
        $this->assertStringContainsString('text/html', $response->headers->get('content-type'));
    }

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

    private function getMetarData()
    {
        return "Ibiza / Es Codola, Spain (LEIB)\n" .
                "Aug 22, 2017 - 10:30 PM EDT / 2017.08.23 0230 UTC\n" .
                "Wind: from the W (270 degrees) at 10 MPH (9 KT):0\n" .
                "Visibility: 3 mile(s):0\n" .
                "Sky conditions: mostly cloudy\n" .
                "Weather: haze\n" .
                "Heat index: 14\n" .
                "Windchill: 23\n" .
                "Temperature: 75 F (24 C)\n" .
                "Dew Point: 73 F (23 C)\n" .
                "Relative Humidity: 94%\n" .
                "Pressure (altimeter): 29.77 in. Hg (1008 hPa)\n" .
                "Pressure (tendency): 17.27 in. Hg (1008 hPa)\n" .
                "ob: AABP 230230Z 27009KT 5000 HZ SCT010 SCT020 BKN100 24/23\n" .
                "cycle: 2\n";
    }
}
