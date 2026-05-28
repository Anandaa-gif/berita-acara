<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\NewDataNotification;
use Illuminate\Support\Facades\Notification;
class MaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $query = Maintenance::with('user');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama_pel', 'like', "%{$search}%")
                  ->orWhere('alamat_pel', 'like', "%{$search}%");
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
        if (!Auth::user()->hasRole('admin')) {
            $query->where('user_id', Auth::id());
        }

        $maintenances = $query->latest()->paginate(10)->withQueryString();

        return view('maintenance.index', compact('maintenances'));
    }

    public function store(Request $request, TelegramService $telegramService)
    {
        $validated = $request->validate([
            'jenis_kegiatan' => 'nullable|string|max:255',
            'nama_pel' => 'required|string|max:255',
            'alamat_pel' => 'required|string',
            'komplain' => 'required|string',
            'action' => 'required|string',
            'tehnisi_1' => 'required|string|max:255',
            'tehnisi_2' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();

        $maintenance = Maintenance::create($validated);

        // Send System Notification
        $usersToNotify = User::where('id', '!=', Auth::id())->get();
        if ($usersToNotify->isNotEmpty()) {
            Notification::send($usersToNotify, new NewDataNotification(
                'Laporan Maintenance Baru',
                Auth::user()->name . ' menambahkan Maintenance untuk ' . $maintenance->nama_pel,
                route('maintenance.index')
            ));
        }

        // Kirim Notifikasi Telegram
        $jenisStr = $maintenance->jenis_kegiatan ? strtoupper($maintenance->jenis_kegiatan) : 'MAINTENANCE';
        $message = "<b>🛠 LAPORAN {$jenisStr}</b>\n\n";
        $message .= "👤 Pelanggan: {$maintenance->nama_pel}\n";
        $message .= "📍 Alamat: {$maintenance->alamat_pel}\n";
        $message .= "❗ Komplain: {$maintenance->komplain}\n";
        $message .= "✅ Action: {$maintenance->action}\n";
        $message .= "🔧 Teknisi: {$maintenance->tehnisi_1} & {$maintenance->tehnisi_2}\n";
        if ($maintenance->keterangan) {
            $message .= "📝 Keterangan: {$maintenance->keterangan}\n";
        }
        $message .= "\n<i>Data maintenance telah berhasil diinput.</i>";

        $telegramService->sendMessage($message, 'maintenance');

        return redirect()->route('maintenance.index')->with('success', 'Data Maintenance berhasil ditambahkan.');
    }

    public function show($id)
    {
        $maintenance = Maintenance::findOrFail($id);

        // Authorization
        if ($maintenance->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }
        
        if (request()->ajax()) {
            return response()->json($maintenance);
        }

        return view('maintenance.show', compact('maintenance'));
    }


    public function update(Request $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);

        // Authorization
        if ($maintenance->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }

        $validated = $request->validate([
            'jenis_kegiatan' => 'nullable|string|max:255',
            'nama_pel' => 'required|string|max:255',
            'alamat_pel' => 'required|string',
            'komplain' => 'required|string',
            'action' => 'required|string',
            'tehnisi_1' => 'required|string|max:255',
            'tehnisi_2' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        $maintenance->update($validated);

        return redirect()->route('maintenance.index')->with('success', 'Data Maintenance berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $maintenance = Maintenance::findOrFail($id);

        // Authorization
        if ($maintenance->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }

        $maintenance->delete();

        return redirect()->route('maintenance.index')->with('success', 'Data Maintenance berhasil dihapus.');
    }
}
