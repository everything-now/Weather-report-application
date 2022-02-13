<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Repositories\MetarRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Log;

class MetarRepositoryTest extends TestCase
{
    public function test_get_data_by_code()
    {
        $mock = new MockHandler([
            new Response(200, [], $this->getMetarData())
        ]);

        $client = new Client(['handler' => HandlerStack::create($mock)]);

        $repository = new MetarRepository($client, new Log);
        $data = $repository->getDataByCode('wrong');

        $this->assertEquals($data, $this->getMetarData());
    }

    public function test_get_data_by_wrong_code()
    {
        $mock = new MockHandler([
            new Response(404)
        ]);

        $client = new Client(['handler' => HandlerStack::create($mock)]);

        $repository = new MetarRepository($client, new Log);
        $data = $repository->getDataByCode('wrong');

        $this->assertNull($data);
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
