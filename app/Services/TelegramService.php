<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TelegramService
{
    protected $token;
    protected $chatId;

    public function __construct()
    {
        $this->token = \App\Models\Setting::get('telegram_bot_token', env('TELEGRAM_BOT_TOKEN'));
        $this->chatId = \App\Models\Setting::get('telegram_chat_id', env('TELEGRAM_CHAT_ID'));
    }

    /**
     * Send a message to Telegram.
     *
     * @param string $message
     * @param string $module
     * @return bool
     */
    public function sendMessage($message, $module = 'berita_acara')
    {
        $token = null;
        $chatId = null;

        if ($module === 'maintenance') {
            $token = \App\Models\Setting::get('telegram_maintenance_token');
            $chatId = \App\Models\Setting::get('telegram_maintenance_chat_id');
        } elseif ($module === 'vendor') {
            $token = \App\Models\Setting::get('telegram_vendor_token');
            $chatId = \App\Models\Setting::get('telegram_vendor_chat_id');
        } elseif ($module === 'backbone') {
            $token = \App\Models\Setting::get('telegram_backbone_token');
            $chatId = \App\Models\Setting::get('telegram_backbone_chat_id');
        } elseif ($module === 'berita_acara') {
            $token = \App\Models\Setting::get('telegram_bot_token', $this->token);
            $chatId = \App\Models\Setting::get('telegram_chat_id', $this->chatId);
        }

        if (!$token || !$chatId) {
            Log::warning("Telegram Token or Chat ID not set for module: {$module}");
            return false;
        }

        try {
            $response = Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'HTML',
            ]);

            if ($response->failed()) {
                Log::error('Telegram API error: ' . $response->body());
                return false;
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Telegram Exception: ' . $e->getMessage());
            return false;
        }
    }

    public function sendPhoto($photoPath, $caption = '', $module = 'berita_acara')
    {
        $token = null;
        $chatId = null;

        if ($module === 'maintenance') {
            $token = \App\Models\Setting::get('telegram_maintenance_token');
            $chatId = \App\Models\Setting::get('telegram_maintenance_chat_id');
        } elseif ($module === 'vendor') {
            $token = \App\Models\Setting::get('telegram_vendor_token');
            $chatId = \App\Models\Setting::get('telegram_vendor_chat_id');
        } elseif ($module === 'backbone') {
            $token = \App\Models\Setting::get('telegram_backbone_token');
            $chatId = \App\Models\Setting::get('telegram_backbone_chat_id');
        } elseif ($module === 'berita_acara') {
            $token = \App\Models\Setting::get('telegram_bot_token', $this->token);
            $chatId = \App\Models\Setting::get('telegram_chat_id', $this->chatId);
        }

        if (!$token || !$chatId) {
            Log::warning("Telegram Token or Chat ID not set for module: {$module}");
            return false;
        }

        try {
            $response = Http::attach('photo', file_get_contents($photoPath), basename($photoPath))
                ->post("https://api.telegram.org/bot{$token}/sendPhoto", [
                    'chat_id' => $chatId,
                    'caption' => $caption,
                    'parse_mode' => 'HTML',
                ]);

            if ($response->failed()) {
                Log::error('Telegram API error (sendPhoto): ' . $response->body());
                return false;
            }

            return true;
        } catch (\Exception $e) {
            Log::error('Telegram Exception (sendPhoto): ' . $e->getMessage());
            return false;
        }
    }
}
