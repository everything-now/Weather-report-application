<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\MetarObservationDecoder;

class MetarObservationDecoderTest extends TestCase
{
    public function test_set_and_get_data()
    {
        $decoder = new MetarObservationDecoder('AABP', $this->getMetarData());

        $this->assertEquals($decoder->airportCode, 'AABP');
        $this->assertEquals($decoder->airportName, 'Ibiza / Es Codola, Spain (LEIB)');
        $this->assertEquals($decoder->date, 'Aug 22, 2017 - 10:30 PM EDT / 2017.08.23 0230 UTC');
        $this->assertEquals($decoder->wind, 'from the W (270 degrees) at 10 MPH (9 KT):0');
        $this->assertEquals($decoder->visibility, '3 mile(s):0');
        $this->assertEquals($decoder->skyConditions, 'mostly cloudy');
        $this->assertEquals($decoder->temperature, '75 F (24 C)');
        $this->assertEquals($decoder->weather, 'haze');
        $this->assertEquals($decoder->heatIndex, '14');
        $this->assertEquals($decoder->windchill, '23');
        $this->assertEquals($decoder->dewPoint, '73 F (23 C)');
        $this->assertEquals($decoder->relativeHumidity, '94%');
        $this->assertEquals($decoder->pressureAltimeter, '29.77 in. Hg (1008 hPa)');
        $this->assertEquals($decoder->pressureTendency, '17.27 in. Hg (1008 hPa)');
        $this->assertEquals($decoder->ob, 'AABP 230230Z 27009KT 5000 HZ SCT010 SCT020 BKN100 24/23');
        $this->assertEquals($decoder->cycle, '2');
    }

    public function test_does_not_exists()
    {
        $decoder = new MetarObservationDecoder('WRONG', null);

        $this->assertFalse($decoder->exists);
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
