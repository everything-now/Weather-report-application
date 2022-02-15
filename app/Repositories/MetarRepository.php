<?php

namespace App\Repositories;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class MetarRepository
{
    protected $log;
    protected $client;

    /**
     * Class constructor
     *
     * @param object $client GuzzleHttp\Client
     */
    public function __construct($client = null)
    {
        if (!$client) {
            $client = new Client([
                'base_uri' => config('metar.base_uri'),
            ]);
        }

        $this->client = $client;
        $this->log = app('log');
        $this->cache = app('cache');
    }

    /**
     * Get observation data from client
     *
     * @param string $code
     * @return string
     */
    public function getDataByCode($code)
    {
        $this->log->info("Started getting $code from repository");

        if ($this->cache->has($code) && config('metar.cache.enabled')) {
            $this->log->info("$code found and fetch from cache");

            return $this->cache->get($code);
        }

        try {
            $response = $this->client->get("$code.TXT");
            $data = $response->getBody()->getContents();

            $this->log->info("$code found from repository");

            $this->cache->put($code, $data, config('metar.cache.seconds'));
            $this->log->info("$code put to cache");

        } catch (RequestException $e) {
            $data = null;

            $this->log->warning("Observation with code $code doesn't exist.");
        }

        return $data;
    }

}
