<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class RuckusService
{
    protected $baseUrl;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->baseUrl = rtrim(env('RUCKUS_URL'), '/');
        $this->username = env('RUCKUS_USERNAME');
        $this->password = env('RUCKUS_PASSWORD');
    }

    /**
     * Ambil service ticket (token) dari Ruckus, simpan di cache 60 menit
     */
    public function getToken()
    {
        return Cache::remember('ruckus_token', 60, function () {
            $response = Http::withoutVerifying()->post($this->baseUrl . '/serviceTicket', [
                'username' => $this->username,
                'password' => $this->password,
            ]);
            if ($response->successful() && isset($response['serviceTicket'])) {
                return $response['serviceTicket'];
            }
            throw new \Exception('Gagal mendapatkan token Ruckus: ' . $response->body());
        });
    }

    /**
     * Ambil summary AP dari Ruckus
     */
    public function getApSummary($deviceId)
    {
        $token = $this->getToken();
        $url = $this->baseUrl . "/aps/{$deviceId}/operational/summary?serviceTicket={$token}";
        $response = Http::withoutVerifying()->get($url);
        Log::info($response->body());
        if ($response->successful()) {
            return $response->json();
        }
        return null;
    }
} 