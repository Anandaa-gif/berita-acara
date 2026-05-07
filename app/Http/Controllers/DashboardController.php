<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use App\Models\Maintenance;
use App\Models\Vendor;
use App\Models\Backbone;
use Illuminate\Http\Request;
use App\Services\TelegramService;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_ba' => BeritaAcara::count(),
            'total_maintenance' => Maintenance::count(),
            'total_vendor' => Vendor::count(),
            'total_backbone' => Backbone::count(),
        ];

        $recent_ba = BeritaAcara::latest()->take(5)->get(); // Keep this just in case, but fetch login logs too
        $login_logs = \App\Models\LoginLog::with('user')->latest()->take(10)->get();

        return view('dashboard', compact('stats', 'recent_ba', 'login_logs'));
    }

    public function testTelegram(TelegramService $telegramService)
    {
        $success = $telegramService->sendMessage("<b>🚀 TEST KONEKSI</b>\n\nBot Telegram berhasil terhubung dengan aplikasi Berita Acara.");

        if ($success) {
            return back()->with('success', 'Pesan test berhasil dikirim ke Telegram!');
        }

        return back()->with('error', 'Gagal mengirim pesan. Pastikan Token dan Chat ID di .env sudah benar.');
    }
}
