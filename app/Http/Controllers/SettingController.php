<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        // For now, redirect to whatsapp settings if it's the only one
        return redirect()->route('settings.whatsapp');
    }

    public function whatsapp()
    {
        $settings = [
            'wa_vendor' => Setting::get('wa_vendor', 'FONNTE'),
            'wa_token' => Setting::get('wa_token', ''),
            'wa_delay' => Setting::get('wa_delay', '0'),
            'wa_notify_number' => Setting::get('wa_notify_number', ''),
            'wa_send_pdf' => Setting::get('wa_send_pdf', '0'),
            'telegram_bot_token' => Setting::get('telegram_bot_token', ''),
            'telegram_chat_id' => Setting::get('telegram_chat_id', ''),
            'telegram_maintenance_token' => Setting::get('telegram_maintenance_token', ''),
            'telegram_maintenance_chat_id' => Setting::get('telegram_maintenance_chat_id', ''),
            'telegram_vendor_token' => Setting::get('telegram_vendor_token', ''),
            'telegram_vendor_chat_id' => Setting::get('telegram_vendor_chat_id', ''),
            'telegram_backbone_token' => Setting::get('telegram_backbone_token', ''),
            'telegram_backbone_chat_id' => Setting::get('telegram_backbone_chat_id', ''),
        ];

        return view('settings.whatsapp', compact('settings'));
    }

    public function updateWhatsapp(Request $request)
    {
        $request->validate([
            'wa_vendor' => 'required|string',
            'wa_token' => 'required|string',
            'wa_delay' => 'required|numeric|min:0',
            'wa_notify_number' => 'nullable|string',
            'wa_send_pdf' => 'nullable|string',
            'telegram_bot_token' => 'nullable|string',
            'telegram_chat_id' => 'nullable|string',
            'telegram_maintenance_token' => 'nullable|string',
            'telegram_maintenance_chat_id' => 'nullable|string',
            'telegram_vendor_token' => 'nullable|string',
            'telegram_vendor_chat_id' => 'nullable|string',
            'telegram_backbone_token' => 'nullable|string',
            'telegram_backbone_chat_id' => 'nullable|string',
        ]);

        Setting::set('wa_vendor', $request->wa_vendor);
        Setting::set('wa_token', $request->wa_token);
        Setting::set('wa_delay', $request->wa_delay);
        Setting::set('wa_notify_number', $request->wa_notify_number);
        Setting::set('wa_send_pdf', $request->wa_send_pdf ?? '0');
        Setting::set('telegram_bot_token', $request->telegram_bot_token);
        Setting::set('telegram_chat_id', $request->telegram_chat_id);
        Setting::set('telegram_maintenance_token', $request->telegram_maintenance_token);
        Setting::set('telegram_maintenance_chat_id', $request->telegram_maintenance_chat_id);
        Setting::set('telegram_vendor_token', $request->telegram_vendor_token);
        Setting::set('telegram_vendor_chat_id', $request->telegram_vendor_chat_id);
        Setting::set('telegram_backbone_token', $request->telegram_backbone_token);
        Setting::set('telegram_backbone_chat_id', $request->telegram_backbone_chat_id);

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui.');
    }

    public function testWhatsapp(Request $request, \App\Services\WhatsappService $whatsappService)
    {
        // Override settings if provided in request (allows testing before saving)
        if ($request->has('wa_token')) {
            $whatsappService->setToken($request->wa_token);
        }
        if ($request->has('wa_vendor')) {
            $whatsappService->setVendor($request->wa_vendor);
        }
        
        $target = $request->wa_notify_number ?? null;
        
        $success = $whatsappService->sendMessage("Halo! Ini adalah pesan uji coba dari sistem MEGADATA ISP. Koneksi WhatsApp Gateway Anda berhasil terhubung.", $target);

        if ($success) {
            return redirect()->back()->with('success', 'Pesan uji coba berhasil dikirim!');
        } else {
            return redirect()->back()->with('error', 'Gagal mengirim pesan uji coba. Periksa token, nomor target, atau koneksi internet.');
        }
    }
}
