<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\NewDataNotification;
use Illuminate\Support\Facades\Notification;
class VendorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $query = Vendor::with('user');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('jenis_kegiatan', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
        } elseif ($startDate) {
            $query->where('created_at', '>=', $startDate . ' 00:00:00');
        } elseif ($endDate) {
            $query->where('created_at', '<=', $endDate . ' 23:59:59');
        }

        // Restrict non-admin users to their own records
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            $query->where('user_id', $user->id);
        }

        $vendors = $query->latest()->paginate(10)->withQueryString();

        return view('vendor.index', compact('vendors'));
    }

    public function store(Request $request, TelegramService $telegramService)
    {
        $validated = $request->validate([
            'jenis_kegiatan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'action' => 'nullable|string|max:255',
            'start_koordinat' => 'nullable|string|max:255',
            'end_koordinat' => 'nullable|string|max:255',
            'koordinat' => 'nullable|string|max:255',
            'panjang_kabel' => 'nullable|string|max:255',
            'banyak_core' => 'nullable|string|max:255',
            'jenis_kabel' => 'nullable|string|max:255',
            'spliter' => 'nullable|string|max:255',
            'ratio' => 'nullable|string|max:255',
            'redaman_input' => 'nullable|string|max:255',
            'redaman_output' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'tehnisi_1' => 'required|string|max:255',
            'tehnisi_2' => 'nullable|string|max:255',
            'tehnisi_3' => 'nullable|string|max:255',
            'tehnisi_4' => 'nullable|string|max:255',
            'tehnisi_5' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();

        $vendor = Vendor::create($validated);

        // Send System Notification
        $usersToNotify = User::where('id', '!=', Auth::id())->get();
        if ($usersToNotify->isNotEmpty()) {
            Notification::send($usersToNotify, new NewDataNotification(
                'Data Vendor Baru',
                Auth::user()->name . ' menambahkan data Vendor di ' . $vendor->lokasi,
                route('vendor.index')
            ));
        }

        // Kirim Notifikasi Telegram
        $message = "<b>🏗️ LAPORAN VENDOR ({$vendor->jenis_kegiatan})</b>\n\n";
        $message .= "📋 Kegiatan: {$vendor->jenis_kegiatan}\n";
        $message .= "📍 Lokasi: {$vendor->lokasi}\n";
        
        if ($vendor->action) $message .= "🎬 Action: {$vendor->action}\n";
        if ($vendor->koordinat) $message .= "📍 Koordinat: {$vendor->koordinat}\n";
        if ($vendor->start_koordinat) $message .= "🏁 Start: {$vendor->start_koordinat}\n";
        if ($vendor->end_koordinat) $message .= "🏁 End: {$vendor->end_koordinat}\n";
        if ($vendor->panjang_kabel) $message .= "📏 Panjang: {$vendor->panjang_kabel}\n";
        if ($vendor->jenis_kabel) $message .= "🧶 Kabel: {$vendor->jenis_kabel} ({$vendor->banyak_core})\n";
        if ($vendor->spliter) $message .= "🔀 Spliter: {$vendor->spliter} ({$vendor->ratio})\n";
        if ($vendor->redaman_input) $message .= "📉 Redaman: In {$vendor->redaman_input} / Out {$vendor->redaman_output}\n";
        
        $message .= "🔧 Teknisi: {$vendor->tehnisi_1}" . ($vendor->tehnisi_2 ? ", {$vendor->tehnisi_2}" : "") . "\n";
        if ($vendor->keterangan) $message .= "📝 Keterangan: {$vendor->keterangan}\n";
        
        $message .= "\n<i>Data vendor telah berhasil diinput.</i>";

        $telegramService->sendMessage($message, 'vendor');

        return redirect()->route('vendor.index')->with('success', 'Data Vendor berhasil ditambahkan.');
    }

    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);

        // Authorization
        if ($vendor->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }
        
        if (request()->ajax()) {
            return response()->json($vendor);
        }

        return view('vendor.show', compact('vendor'));
    }

    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);

        // Authorization
        if ($vendor->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }

        $validated = $request->validate([
            'jenis_kegiatan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'action' => 'nullable|string|max:255',
            'start_koordinat' => 'nullable|string|max:255',
            'end_koordinat' => 'nullable|string|max:255',
            'koordinat' => 'nullable|string|max:255',
            'panjang_kabel' => 'nullable|string|max:255',
            'banyak_core' => 'nullable|string|max:255',
            'jenis_kabel' => 'nullable|string|max:255',
            'spliter' => 'nullable|string|max:255',
            'ratio' => 'nullable|string|max:255',
            'redaman_input' => 'nullable|string|max:255',
            'redaman_output' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
            'tehnisi_1' => 'required|string|max:255',
            'tehnisi_2' => 'nullable|string|max:255',
            'tehnisi_3' => 'nullable|string|max:255',
            'tehnisi_4' => 'nullable|string|max:255',
            'tehnisi_5' => 'nullable|string|max:255',
        ]);

        $vendor->update($validated);

        return redirect()->route('vendor.index')->with('success', 'Data Vendor berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);

        // Authorization
        if ($vendor->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }

        $vendor->delete();

        return redirect()->route('vendor.index')->with('success', 'Data Vendor berhasil dihapus.');
    }
}
