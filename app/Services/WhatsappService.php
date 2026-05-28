<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappService
{
    protected $token;
    protected $vendor;
    protected $delay;

    public function setToken($token) { $this->token = $token; return $this; }
    public function setVendor($vendor) { $this->vendor = $vendor; return $this; }
    public function setDelay($delay) { $this->delay = $delay; return $this; }

    public function __construct()
    {
        $this->token = Setting::get('wa_token');
        $this->vendor = Setting::get('wa_vendor', 'FONNTE');
        $this->delay = Setting::get('wa_delay', 0);
    }

    /**
     * Send a message via WhatsApp Gateway.
     *
     * @param string|null $target Target phone number (defaults to wa_notify_number)
     * @param string $message Message content
     * @return bool
     */
    public function sendMessage($message, $target = null)
    {
        $target = $target ?? Setting::get('wa_notify_number');

        if (!$this->token || !$target) {
            Log::warning('WhatsApp Token or Target Number not set in settings');
            return false;
        }

        // Format target number (replace leading 0 with 62)
        if (substr($target, 0, 1) === '0') {
            $target = '62' . substr($target, 1);
        }

        // Strip HTML tags for WhatsApp
        $message = str_replace(['<b>', '</b>', '<i>', '</i>', '<br>', '<br/>', '<br />'], ['', '', '_', '_', "\n", "\n", "\n"], $message);
        $message = strip_tags($message);

        // Apply delay if set
        if ($this->delay > 0) {
            sleep((int)$this->delay);
        }

        try {
            if ($this->vendor === 'FONNTE') {
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => $this->token,
                ])->post('https://api.fonnte.com/send', [
                    'target' => $target,
                    'message' => $message,
                    'countryCode' => '62', // Default to Indonesia
                ]);

                $data = $response->json();
                $isSuccess = $response->successful() && ($data['status'] ?? false) === true;
                
                \App\Models\MessageLog::create([
                    'gateway' => 'whatsapp',
                    'target' => $target,
                    'message' => $message,
                    'status' => $isSuccess ? 'success' : 'failed',
                    'response' => $response->body()
                ]);
                
                if (!$isSuccess) {
                    Log::error('Fonnte API error: ' . $response->body());
                    return false;
                }

                return true;
            }

            Log::warning('Unsupported WhatsApp Vendor: ' . $this->vendor);
            return false;
        } catch (\Exception $e) {
            \App\Models\MessageLog::create([
                'gateway' => 'whatsapp',
                'target' => $target,
                'message' => $message,
                'status' => 'failed',
                'response' => 'Exception: ' . $e->getMessage()
            ]);
            Log::error('WhatsApp Exception: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send a file via WhatsApp Gateway.
     *
     * @param string $filePath Absolute path to the file
     * @param string $message Optional message content
     * @param string|null $target Target phone number
     * @return bool
     */
    public function sendFile($filePath, $message = '', $target = null)
    {
        $target = $target ?? Setting::get('wa_notify_number');

        if (!$this->token || !$target) {
            Log::warning('WhatsApp Token or Target Number not set in settings');
            return false;
        }

        // Format target number
        if (substr($target, 0, 1) === '0') {
            $target = '62' . substr($target, 1);
        }

        // Apply delay if set
        if ($this->delay > 0) {
            sleep((int)$this->delay);
        }

        try {
            if ($this->vendor === 'FONNTE') {
                $response = Http::withoutVerifying()
                    ->withHeaders(['Authorization' => $this->token])
                    ->attach('file', file_get_contents($filePath), basename($filePath))
                    ->post('https://api.fonnte.com/send', [
                        'target' => $target,
                        'message' => $message,
                        'countryCode' => '62',
                    ]);

                $data = $response->json();
                $isSuccess = $response->successful() && ($data['status'] ?? false) === true;
                
                \App\Models\MessageLog::create([
                    'gateway' => 'whatsapp',
                    'target' => $target,
                    'message' => $message ? $message . ' [ATTACHMENT: ' . basename($filePath) . ']' : '[ATTACHMENT: ' . basename($filePath) . ']',
                    'status' => $isSuccess ? 'success' : 'failed',
                    'response' => $response->body()
                ]);

                if (!$isSuccess) {
                    Log::error('Fonnte API error: ' . $response->body());
                    return false;
                }

                return true;
            }

            return false;
        } catch (\Exception $e) {
            \App\Models\MessageLog::create([
                'gateway' => 'whatsapp',
                'target' => $target,
                'message' => $message ? $message . ' [ATTACHMENT: ' . basename($filePath) . ']' : '[ATTACHMENT: ' . basename($filePath) . ']',
                'status' => 'failed',
                'response' => 'Exception: ' . $e->getMessage()
            ]);
            Log::error('WhatsApp File Exception: ' . $e->getMessage());
            return false;
        }
    }
}
