<?php

namespace App\Services;

class MetarObservationDecoder
{
    public $airportCode;
    public $airportName;
    public $exists;
    public $date;
    public $wind;
    public $visibility;
    public $skyConditions;
    public $temperature;
    public $weather;
    public $heatIndex;
    public $windchill;
    public $dewPoint;
    public $relativeHumidity;
    public $pressureAltimeter;
    public $pressureTendency;
    public $ob;
    public $cycle;

    /**
     * Class constructor
     *
     * @param string $airportCode
     * @param string $data
     */
    public function __construct($airportCode, $data)
    {
        $this->setAirportCode($airportCode);
        $this->setAirportName($data);
        $this->setExists($data);
        $this->setDate($data);
        $this->setWind($data);
        $this->setVisibility($data);
        $this->setSkyConditions($data);
        $this->setTemperature($data);
        $this->setWeather($data);
        $this->setHeatIndex($data);
        $this->setWindchill($data);
        $this->setDewPoint($data);
        $this->setRelativeHumidity($data);
        $this->setPressureAltimeter($data);
        $this->setPressureTendency($data);
        $this->setOb($data);
        $this->setCycle($data);
    }

    /**
     * Set airportCode
     *
     * @param string $code
     * @return void
     */
    protected function setAirportCode($code)
    {
        $this->airportCode = $code;
    }

    /**
     * Set airportName
     *
     * @param string $data
     * @return void
     */
    protected function setAirportName($data)
    {
        $data = explode("\n", $data);

        $this->airportName = $data[0] ?? null;
    }

    /**
     * Set exists
     *
     * @param string $data
     * @return void
     */
    protected function setExists($data)
    {
        $this->exists = !is_null($data);
    }

    /**
     * Set date
     *
     * @param string $data
     * @return void
     */
    protected function setDate($data)
    {
        $data = explode("\n", $data);

        $this->date = $data[1] ?? null;
    }

    /**
     * Set wind
     *
     * @param string $data
     * @return void
     */
    protected function setWind($data)
    {
        preg_match('/Wind: (.*?)\n/', $data, $match);

        $this->wind = $match[1] ?? null;
    }

    /**
     * Set visibility
     *
     * @param string $data
     * @return void
     */
    protected function setVisibility($data)
    {
        preg_match('/Visibility: (.*?)\n/', $data, $match);

        $this->visibility = $match[1] ?? null;
    }

    /**
     * Set skyConditions
     *
     * @param string $data
     * @return void
     */
    protected function setSkyConditions($data)
    {
        preg_match('/Sky conditions: (.*?)\n/', $data, $match);

        $this->skyConditions = $match[1] ?? null;
    }

    /**
     * Set temperature
     *
     * @param string $data
     * @return void
     */
    protected function setTemperature($data)
    {
        preg_match('/Temperature: (.*?)\n/', $data, $match);

        $this->temperature = $match[1] ?? null;
    }

    /**
     * Set weather
     *
     * @param string $data
     * @return void
     */
    protected function setWeather($data)
    {
        preg_match('/Weather: (.*?)\n/', $data, $match);

        $this->weather = $match[1] ?? null;
    }

    /**
     * Set heatIndex
     *
     * @param string $data
     * @return void
     */
    protected function setHeatIndex($data)
    {
        preg_match('/Heat index: (.*?)\n/', $data, $match);

        $this->heatIndex = $match[1] ?? null;
    }

    /**
     * Set windchill
     *
     * @param string $data
     * @return void
     */
    protected function setWindchill($data)
    {
        preg_match('/Windchill: (.*?)\n/', $data, $match);

        $this->windchill = $match[1] ?? null;
    }

    /**
     * Set dewPoint
     *
     * @param string $data
     * @return void
     */
    protected function setDewPoint($data)
    {
        preg_match('/Dew Point: (.*?)\n/', $data, $match);

        $this->dewPoint = $match[1] ?? null;
    }

    /**
     * Set relativeHumidity
     *
     * @param string $data
     * @return void
     */
    protected function setRelativeHumidity($data)
    {
        preg_match('/Relative Humidity: (.*?)\n/', $data, $match);

        $this->relativeHumidity = $match[1] ?? null;
    }

    /**
     * Set pressureAltimeter
     *
     * @param string $data
     * @return void
     */
    protected function setPressureAltimeter($data)
    {
        preg_match('/Pressure \(altimeter\): (.*?)\n/', $data, $match);

        $this->pressureAltimeter = $match[1] ?? null;
    }

    /**
     * Set pressureTendency
     *
     * @param string $data
     * @return void
     */
    protected function setPressureTendency($data)
    {
        preg_match('/Pressure \(tendency\): (.*?)\n/', $data, $match);

        $this->pressureTendency = $match[1] ?? null;
    }

    /**
     * Set ob
     *
     * @param string $data
     * @return void
     */
    protected function setOb($data)
    {
        preg_match('/ob: (.*?)\n/', $data, $match);

        $this->ob = $match[1] ?? null;
    }

    /**
     * Set cycle
     *
     * @param string $data
     * @return void
     */
    protected function setCycle($data)
    {
        preg_match('/cycle: (.*?)\n/', $data, $match);

        $this->cycle = $match[1] ?? null;
    }
}
