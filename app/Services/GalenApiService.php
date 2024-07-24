<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class GalenApiService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('GALEN_API_BASE_URL'),
        ]);
    }

    public function login($email, $password)
    {

        try {
            $response = $this->client->post('/auth/login', [
                'headers' => [
                    'accept' => 'application/json',
                    'X-TENANT-DOMAIN' => env('GALEN_TENANT_DOMAIN', 'feeltect-dev.galencloud.com'),
                    'X-API-VERSION' => '3',
                    'X-APP-TYPE' => 'Device',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Authorization' => 'Bearer ' . env('GALEN_BEARER_TOKEN'),
                ],
                'form_params' => [
                    'emailAddress' => $email,
                    'password' => $password,
                    'sendMFACode' => false,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error('Galen API login error: ' . $e->getMessage());
            return null;
        }
    }

    public function helloworld()
    {
        return "hello world";
    }
}
