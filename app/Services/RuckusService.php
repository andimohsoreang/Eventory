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
            try {
                $response = Http::withoutVerifying()->post($this->baseUrl . '/serviceTicket', [
                    'username' => $this->username,
                    'password' => $this->password,
                ]);
                
                if ($response->successful() && isset($response['serviceTicket'])) {
                    return $response['serviceTicket'];
                }
                
                Log::error('Failed to get Ruckus token', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);
                
                throw new \Exception('Failed to get Ruckus token: ' . $response->body());
            } catch (\Exception $e) {
                Log::error('Error getting Ruckus token', ['error' => $e->getMessage()]);
                throw $e;
            }
        });
    }

    public function getZone()
    {
        try {
            $token = $this->getToken();
            $url = $this->baseUrl . "/rkszones?serviceTicket={$token}";
            $response = Http::withoutVerifying()->get($url);
            
            Log::info('Zone response', ['status' => $response->status(), 'body' => $response->json()]);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            Log::error('Failed to get zones', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            
            return ['list' => []];
        } catch (\Exception $e) {
            Log::error('Error getting zones', ['error' => $e->getMessage()]);
            return ['list' => []];
        }
    }

    public function getGedung($zoneId)
    {
        try {
            $token = $this->getToken();
            $url = $this->baseUrl . "/rkszones/{$zoneId}/apgroups?serviceTicket={$token}";
            $response = Http::withoutVerifying()->get($url);
            
            Log::info('Building response', [
                'zone_id' => $zoneId,
                'status' => $response->status(),
                'body' => $response->json()
            ]);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            Log::error('Failed to get buildings', [
                'zone_id' => $zoneId,
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            
            return ['list' => []];
        } catch (\Exception $e) {
            Log::error('Error getting buildings', [
                'zone_id' => $zoneId,
                'error' => $e->getMessage()
            ]);
            return ['list' => []];
        }
    }

    public function getMac($zoneId, $gedungId)
    {
        try {
            $token = $this->getToken();
            $url = $this->baseUrl . "/rkszones/{$zoneId}/apgroups/{$gedungId}?serviceTicket={$token}";
            $response = Http::withoutVerifying()->get($url);
            
            Log::info('MAC response', [
                'zone_id' => $zoneId,
                'gedung_id' => $gedungId,
                'status' => $response->status(),
                'body' => $response->json()
            ]);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            Log::error('Failed to get MAC', [
                'zone_id' => $zoneId,
                'gedung_id' => $gedungId,
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            
            return null;
        } catch (\Exception $e) {
            Log::error('Error getting MAC', [
                'zone_id' => $zoneId,
                'gedung_id' => $gedungId,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }

    /**
     * Ambil summary AP dari Ruckus
     */
    public function getApSummary($deviceId)
    {
        try {
            $token = $this->getToken();
            $url = $this->baseUrl . "/aps/{$deviceId}/operational/summary?serviceTicket={$token}";
            $response = Http::withoutVerifying()->get($url);
            
            Log::info('AP Summary response', [
                'device_id' => $deviceId,
                'status' => $response->status(),
                'body' => $response->json()
            ]);
            
            if ($response->successful()) {
                return $response->json();
            }
            
            Log::error('Failed to get AP Summary', [
                'device_id' => $deviceId,
                'status' => $response->status(),
                'body' => $response->body()
            ]);
            
            return null;
        } catch (\Exception $e) {
            Log::error('Error getting AP Summary', [
                'device_id' => $deviceId,
                'error' => $e->getMessage()
            ]);
            return null;
        }
    }
}