<?php

namespace App\Http\Controllers;

use App\Models\Backbone;
use Illuminate\Http\Request;
use App\Services\TelegramService;
use Illuminate\Support\Facades\Auth;

class BackboneController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        $query = Backbone::with('user');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('lokasi', 'like', "%{$search}%")
                  ->orWhere('tiang_odp', 'like', "%{$search}%");
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

        $backbones = $query->latest()->paginate(10)->withQueryString();

        return view('backbone.index', compact('backbones'));
    }

    public function store(Request $request, TelegramService $telegramService)
    {
        $validated = $request->validate([
            'jenis_kegiatan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tiang_odp' => 'nullable|string|max:255',
            'action' => 'nullable|string',
            'titik_koordinat' => 'nullable|string|max:255',
            'ratio' => 'nullable|string|max:255',
            'splitter' => 'nullable|string|max:255',
            'redaman_input' => 'nullable|string|max:255',
            'redaman_output' => 'nullable|string|max:255',
            'tehnisi_1' => 'required|string|max:255',
            'tehnisi_2' => 'nullable|string|max:255',
            'tehnisi_3' => 'nullable|string|max:255',
            'tehnisi_4' => 'nullable|string|max:255',
            'tehnisi_5' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();

        $backbone = Backbone::create($validated);

        // Kirim Notifikasi Telegram
        $message = "<b>🌐 DATA " . strtoupper($backbone->jenis_kegiatan) . " BARU</b>\n\n";
        $message .= "📍 Lokasi: {$backbone->lokasi}\n";
        
        if ($backbone->tiang_odp) $message .= "🗼 Tiang ODP: {$backbone->tiang_odp}\n";
        
        if ($backbone->jenis_kegiatan == 'UP ODP') {
            if ($backbone->ratio) $message .= "🔀 Ratio: {$backbone->ratio}\n";
            if ($backbone->splitter) $message .= "🔀 Splitter: {$backbone->splitter}\n";
        } elseif ($backbone->jenis_kegiatan == 'Backbone') {
            if ($backbone->titik_koordinat) $message .= "📍 Koordinat: {$backbone->titik_koordinat}\n";
        }
        
        if ($backbone->redaman_input || $backbone->redaman_output) {
            $message .= "📏 Redaman: Input {$backbone->redaman_input} / Output {$backbone->redaman_output}\n";
        }
        
        if ($backbone->action) $message .= "✅ Action: {$backbone->action}\n";
        
        $teknisi = array_filter([$backbone->tehnisi_1, $backbone->tehnisi_2, $backbone->tehnisi_3, $backbone->tehnisi_4, $backbone->tehnisi_5]);
        $message .= "🔧 Teknisi: " . implode(', ', $teknisi) . "\n";
        if ($backbone->keterangan) $message .= "📝 Keterangan: {$backbone->keterangan}\n";
        $message .= "\n<i>Data telah berhasil diinput.</i>";

        $telegramService->sendMessage($message, 'backbone');

        return redirect()->route('backbone.index')->with('success', 'Data Backbone berhasil ditambahkan.');
    }

    public function show($id)
    {
        $backbone = Backbone::findOrFail($id);

        // Authorization
        if ($backbone->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }
        
        if (request()->ajax()) {
            return response()->json($backbone);
        }

        return view('backbone.show', compact('backbone'));
    }

    public function update(Request $request, $id)
    {
        $backbone = Backbone::findOrFail($id);

        // Authorization
        if ($backbone->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }

        $validated = $request->validate([
            'jenis_kegiatan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tiang_odp' => 'nullable|string|max:255',
            'action' => 'nullable|string',
            'titik_koordinat' => 'nullable|string|max:255',
            'ratio' => 'nullable|string|max:255',
            'splitter' => 'nullable|string|max:255',
            'redaman_input' => 'nullable|string|max:255',
            'redaman_output' => 'nullable|string|max:255',
            'tehnisi_1' => 'required|string|max:255',
            'tehnisi_2' => 'nullable|string|max:255',
            'tehnisi_3' => 'nullable|string|max:255',
            'tehnisi_4' => 'nullable|string|max:255',
            'tehnisi_5' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $backbone->update($validated);

        return redirect()->route('backbone.index')->with('success', 'Data Backbone berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $backbone = Backbone::findOrFail($id);

        // Authorization
        if ($backbone->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }

        $backbone->delete();

        return redirect()->route('backbone.index')->with('success', 'Data Backbone berhasil dihapus.');
    }
}
