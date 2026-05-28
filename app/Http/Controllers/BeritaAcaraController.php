<?php

namespace App\Http\Controllers;

use App\Models\BeritaAcara;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\TelegramService;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Exports\BeritaAcaraExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Notifications\NewDataNotification;
use Illuminate\Support\Facades\Notification;
class BeritaAcaraController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Base query with eager loading
        $query = BeritaAcara::with('user');
        
        // Apply search filter if provided
        $query->when($search, function ($q, $search) {
            return $q->where(function($subQ) use ($search) {
                $subQ->where('nama', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('no_ktp', 'like', "%{$search}%")
                    ->orWhere('no_hp', 'like', "%{$search}%")
                    ->orWhere('paket_berlangganan', 'like', "%{$search}%");
            });
        });

        // Apply date filter
        if ($startDate && $endDate) {
            $query->whereBetween('tanggal_registrasi', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->whereDate('tanggal_registrasi', '>=', $startDate);
        } elseif ($endDate) {
            $query->whereDate('tanggal_registrasi', '<=', $endDate);
        }

        // Restrict non-admin users to their own records only
        if (!Auth::user()->hasRole('admin')) {
            $query->where('user_id', Auth::id());
        }

        $beritaAcaras = $query->latest()->paginate(10)->withQueryString();

        return view('berita-acara.index', compact('beritaAcaras', 'search', 'startDate', 'endDate'));
    }

    public function create()
    {
        return view('berita-acara.create');
    }

    public function show(BeritaAcara $beritaAcara)
    {
        // Authorization: only owner or admin can view
        if ($beritaAcara->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }

        return view('berita-acara.show', compact('beritaAcara'));
    }

    public function store(Request $request, TelegramService $telegramService, WhatsappService $whatsappService)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'no_ktp' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'google_maps_link' => 'nullable|string|url',
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
        
        // Clean currency input (remove dots/commas)
        $cleanBiaya = preg_replace('/[^0-9]/', '', $request->biaya_registrasi);
        $validated['biaya_registrasi'] = (int) $cleanBiaya;

        $beritaAcara = BeritaAcara::create($validated);

        // Send System Notification
        $usersToNotify = User::where('id', '!=', Auth::id())->get();
        if ($usersToNotify->isNotEmpty()) {
            Notification::send($usersToNotify, new NewDataNotification(
                'Berita Acara Baru',
                Auth::user()->name . ' menambahkan Berita Acara untuk ' . $beritaAcara->nama,
                route('berita-acara.show', $beritaAcara->id)
            ));
        }

        // Kirim Notifikasi Telegram
        $message = "<b>🔔 LAPORAN PEMASANGAN BARU</b>\n\n";
        $message .= "👤 Pelanggan: {$beritaAcara->nama}\n";
        $message .= "📍 Alamat: {$beritaAcara->alamat}\n";
        if ($beritaAcara->google_maps_link) {
            $message .= "🗺️ Maps: <a href='{$beritaAcara->google_maps_link}'>Klik Disini</a>\n";
        }
        $message .= "📱 No HP: {$beritaAcara->no_hp}\n";
        $message .= "📦 Paket: {$beritaAcara->paket_berlangganan}\n";
        $message .= "🔧 Teknisi: {$beritaAcara->nama_teknisi_1}" . ($beritaAcara->nama_teknisi_2 ? " & {$beritaAcara->nama_teknisi_2}" : "") . "\n";
        $message .= "📅 Tanggal: " . date('d-m-Y', strtotime($beritaAcara->tanggal_registrasi)) . "\n";
        $message .= "\n<i>Data telah berhasil diinput ke sistem.</i>";

        $telegramService->sendMessage($message);

        // Kirim Notifikasi WhatsApp ke Pelanggan
        $regisFee = number_format(round($beritaAcara->biaya_registrasi), 0, ',', '.');
        
        $customerMessage = "*BERITA ACARA INSTALASI BARU*\n";
        $customerMessage .= "*MEGADATA ISP BESUKI*\n\n";
        $customerMessage .= "Terima kasih telah memilih MEGADATA ISP sebagai mitra layanan internet Anda. Berikut adalah rincian instalasi Anda:\n\n";
        
        $customerMessage .= "*DETAIL PELANGGAN:*\n";
        $customerMessage .= "👤 Nama: {$beritaAcara->nama}\n";
        $customerMessage .= "🆔 No. KTP: {$beritaAcara->no_ktp}\n";
        $customerMessage .= "📱 No. HP: {$beritaAcara->no_hp}\n";
        $customerMessage .= "📍 Alamat: {$beritaAcara->alamat}\n\n";
        
        $customerMessage .= "*PAKET BERLANGGANAN:*\n";
        $customerMessage .= "📦 Paket: {$beritaAcara->paket_berlangganan}\n";
        $customerMessage .= "💳 Biaya Registrasi: Rp {$regisFee}\n\n";
        
        $customerMessage .= "*INFORMASI PERANGKAT:*\n";
        $customerMessage .= "🛠️ Perangkat (Modem/ONT) dipinjamkan oleh pihak MEGADATA ISP dan tetap menjadi hak milik MEGADATA ISP. Pelanggan berkewajiban menjaga perangkat dengan baik selama masa berlangganan.\n\n";
        
        $customerMessage .= "*TIM TEKNISI:*\n";
        $customerMessage .= "👨‍🔧 {$beritaAcara->nama_teknisi_1}\n";
        if ($beritaAcara->nama_teknisi_2) {
            $customerMessage .= "👨‍🔧 {$beritaAcara->nama_teknisi_2}\n";
        }
        
        $customerMessage .= "\nMohon simpan pesan ini sebagai bukti sah instalasi Anda. Jika ada kendala, silakan hubungi layanan Customer Care kami di nomor https://wa.me/6285186823005\n\n";
        $customerMessage .= "Selamat menikmati layanan internet kami! ✨";
        
        $sendPdf = \App\Models\Setting::get('wa_send_pdf', '0');
        $hash = md5($beritaAcara->id . $beritaAcara->created_at);
        $downloadUrl = route('berita-acara.public-download-pdf', ['berita_acara' => $beritaAcara->id, 'hash' => $hash]);

        if ($sendPdf == '1') {
            try {
                $pdf = Pdf::loadView('berita-acara.pdf', compact('beritaAcara'));
                $pdf->setPaper('a4', 'portrait');
                $fileName = 'Berita-Acara-' . str_replace(' ', '-', $beritaAcara->nama) . '.pdf';
                $filePath = storage_path('app/' . $fileName);
                $pdf->save($filePath);
                
                // Masukkan link download ke dalam isi pesan sebagai cadangan jika file PDF gagal/diblokir paket Fonnte
                $messageWithLink = $customerMessage . "\n\n📄 *Download PDF:* " . $downloadUrl;
                
                $success = $whatsappService->sendFile($filePath, $messageWithLink, $beritaAcara->no_hp);
                
                if (file_exists($filePath)) {
                    unlink($filePath);
                }

                // Jika benar-benar gagal total (tidak ada pesan masuk sama sekali), coba kirim ulang teks saja
                if (!$success) {
                    $whatsappService->sendMessage($messageWithLink, $beritaAcara->no_hp);
                }
            } catch (\Exception $e) {
                Log::error('WA PDF Error: ' . $e->getMessage());
                $messageWithLink = $customerMessage . "\n\n📄 *Download PDF:* " . $downloadUrl;
                $whatsappService->sendMessage($messageWithLink, $beritaAcara->no_hp);
            }
        } else {
            $whatsappService->sendMessage($customerMessage, $beritaAcara->no_hp);
        }

        return redirect()->route('berita-acara.index')->with('success', 'Laporan Pemasangan Baru berhasil dibuat.');
    }

    public function edit(BeritaAcara $beritaAcara)
    {
        // Authorization: only owner or admin can edit
        if ($beritaAcara->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }

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
            'google_maps_link' => 'nullable|string|url',
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

        // Clean currency input (remove dots/commas)
        $cleanBiaya = preg_replace('/[^0-9]/', '', $request->biaya_registrasi);
        $validated['biaya_registrasi'] = (int) $cleanBiaya;

        $beritaAcara->update($validated);

        return redirect()->route('berita-acara.index')->with('success', 'Berita Acara berhasil diperbarui.');
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

    public function publicDownloadPdf($id, $hash)
    {
        try {
            $beritaAcara = BeritaAcara::findOrFail($id);
            
            // Security check: verify hash (using md5 of id + created_at)
            $expectedHash = md5($beritaAcara->id . $beritaAcara->created_at);
            
            if ($hash !== $expectedHash) {
                abort(403, 'Link tidak valid atau sudah kadaluarsa.');
            }

            $pdf = Pdf::loadView('berita-acara.pdf', compact('beritaAcara'));
            $pdf->setPaper('a4', 'portrait');
            $fileName = 'Berita-Acara-' . str_replace(' ', '-', $beritaAcara->nama) . '.pdf';
            
            return $pdf->stream($fileName);
        } catch (\Exception $e) {
            Log::error('Public PDF Export Error: ' . $e->getMessage());
            abort(404, 'Data tidak ditemukan.');
        }
    }

    public function destroy(BeritaAcara $beritaAcara)
    {
        // Authorization: only owner or admin can delete
        if ($beritaAcara->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized access');
        }

        // Delete associated files
        if ($beritaAcara->foto_odp) {
            Storage::disk('public')->delete($beritaAcara->foto_odp);
        }
        if ($beritaAcara->foto_rumah) {
            Storage::disk('public')->delete($beritaAcara->foto_rumah);
        }
        if ($beritaAcara->foto_pelanggan) {
            Storage::disk('public')->delete($beritaAcara->foto_pelanggan);
        }

        $beritaAcara->delete();

        return redirect()->route('berita-acara.index')->with('success', 'Laporan Berita Acara berhasil dihapus.');
    }
}
