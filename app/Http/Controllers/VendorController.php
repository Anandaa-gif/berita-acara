<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::latest()->paginate(10);
        return view('vendor.index', compact('vendors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_kegiatan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'start_koordinat' => 'required|string|max:255',
            'end_koordinat' => 'required|string|max:255',
            'panjang_kabel' => 'required|string|max:255',
            'banyak_core' => 'required|string|max:255',
            'jenis_kabel' => 'required|string|max:255',
            'tehnisi_1' => 'required|string|max:255',
            'tehnisi_2' => 'nullable|string|max:255',
            'tehnisi_3' => 'nullable|string|max:255',
            'tehnisi_4' => 'nullable|string|max:255',
            'tehnisi_5' => 'nullable|string|max:255',
        ]);

        Vendor::create($validated);

        return redirect()->route('vendor.index')->with('success', 'Data Vendor berhasil ditambahkan.');
    }

    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);
        return response()->json($vendor);
    }

    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);

        $validated = $request->validate([
            'jenis_kegiatan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'start_koordinat' => 'required|string|max:255',
            'end_koordinat' => 'required|string|max:255',
            'panjang_kabel' => 'required|string|max:255',
            'banyak_core' => 'required|string|max:255',
            'jenis_kabel' => 'required|string|max:255',
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
        $vendor->delete();

        return redirect()->route('vendor.index')->with('success', 'Data Vendor berhasil dihapus.');
    }
}
