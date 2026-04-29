<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Exports\BeritaAcaraExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class BeritaAcaraController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $beritaAcaras = BeritaAcara::with('user')
            ->when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('no_ktp', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%")
                    ->orWhere('paket_berlangganan', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('berita-acara.index', compact('beritaAcaras', 'search'));
    }

    public function create()
    {
        return view('berita-acara.create');
    }

    public function show(BeritaAcara $beritaAcara)
    {
        return view('berita-acara.show', compact('beritaAcara'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'tanggal_registrasi' => 'required|date',
            'paket_berlangganan' => 'required|string',
            'jenis_perangkat' => 'required|string',
            'mac_address' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'biaya_registrasi' => 'required|numeric',
            'nama_teknisi_1' => 'required|string',
            'nama_teknisi_2' => 'nullable|string',
            'foto_odp' => 'nullable|image|mimes:jpeg,png,jpg|max:51200',
            'foto_rumah' => 'nullable|image|mimes:jpeg,png,jpg|max:51200',
            'foto_pelanggan' => 'nullable|image|mimes:jpeg,png,jpg|max:51200',
            'ttd_pelanggan' => 'nullable|string',
            'ttd_petugas' => 'nullable|string',
        ]);

        // Handle File Uploads
        if ($request->hasFile('foto_odp')) {
            $validated['foto_odp'] = $request->file('foto_odp')->store('dokumentasi', 'public');
        }
        if ($request->hasFile('foto_rumah')) {
            $validated['foto_rumah'] = $request->file('foto_rumah')->store('dokumentasi', 'public');
        }
        if ($request->hasFile('foto_pelanggan')) {
            $validated['foto_pelanggan'] = $request->file('foto_pelanggan')->store('dokumentasi', 'public');
        }

        $validated['user_id'] = Auth::id();

        BeritaAcara::create($validated);

        return redirect()->route('berita-acara.index')->with('success', 'Laporan Pemasangan Baru berhasil dibuat.');
    }

    public function edit(BeritaAcara $beritaAcara)
    {
        return view('berita-acara.edit', compact('beritaAcara'));
    }

    public function update(Request $request, BeritaAcara $beritaAcara)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'tanggal_registrasi' => 'required|date',
            'paket_berlangganan' => 'required|string',
            'jenis_perangkat' => 'required|string',
            'mac_address' => 'nullable|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'biaya_registrasi' => 'required|numeric',
            'nama_teknisi_1' => 'required|string',
            'nama_teknisi_2' => 'nullable|string',
            'foto_odp' => 'nullable|image|mimes:jpeg,png,jpg|max:51200',
            'foto_rumah' => 'nullable|image|mimes:jpeg,png,jpg|max:51200',
            'foto_pelanggan' => 'nullable|image|mimes:jpeg,png,jpg|max:51200',
            'ttd_pelanggan' => 'nullable|string',
            'ttd_petugas' => 'nullable|string',
        ]);

        // Handle File Uploads
        if ($request->hasFile('foto_odp')) {
            if ($beritaAcara->foto_odp) {
                Storage::disk('public')->delete($beritaAcara->foto_odp);
            }
            $validated['foto_odp'] = $request->file('foto_odp')->store('dokumentasi', 'public');
        }
        if ($request->hasFile('foto_rumah')) {
            if ($beritaAcara->foto_rumah) {
                Storage::disk('public')->delete($beritaAcara->foto_rumah);
            }
            $validated['foto_rumah'] = $request->file('foto_rumah')->store('dokumentasi', 'public');
        }
        if ($request->hasFile('foto_pelanggan')) {
            if ($beritaAcara->foto_pelanggan) {
                Storage::disk('public')->delete($beritaAcara->foto_pelanggan);
            }
            $validated['foto_pelanggan'] = $request->file('foto_pelanggan')->store('dokumentasi', 'public');
        }

        $beritaAcara->update($validated);

        return redirect()->route('berita-acara.index')->with('success', 'Berita Acara berhasil diperbarui.');
    }

    public function destroy(BeritaAcara $beritaAcara)
    {
        try {
            $beritaAcara->delete();
            return redirect()->route('berita-acara.index')->with('success', 'Berita Acara berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('berita-acara.index')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function exportExcel(Request $request)
    {
        try {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $fileName = 'Laporan-BA-' . $startDate . '-sd-' . $endDate . '.xlsx';

            if (ob_get_contents()) ob_end_clean();
            
            return Excel::download(new BeritaAcaraExport($startDate, $endDate), $fileName, \Maatwebsite\Excel\Excel::XLSX);
        } catch (\Exception $e) {
            Log::error('Export Excel Error: ' . $e->getMessage());
            return redirect()->route('berita-acara.index')->with('error', 'Gagal mengekspor data: ' . $e->getMessage());
        }
    }

    public function downloadPdf(BeritaAcara $beritaAcara)
    {
        try {
            $pdf = Pdf::loadView('berita-acara.pdf', compact('beritaAcara'));
            
            // Set paper size to A4
            $pdf->setPaper('a4', 'portrait');
            
            $fileName = 'Berita-Acara-' . str_replace(' ', '-', $beritaAcara->nama) . '.pdf';
            
            return $pdf->download($fileName);
        } catch (\Exception $e) {
            Log::error('PDF Export Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat PDF: ' . $e->getMessage());
        }
    }
}
