<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::latest()->paginate(10);
        return view('maintenance.index', compact('maintenances'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pel' => 'required|string|max:255',
            'alamat_pel' => 'required|string',
            'komplain' => 'required|string',
            'action' => 'required|string',
            'tehnisi_1' => 'required|string|max:255',
            'tehnisi_2' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        Maintenance::create($validated);

        return redirect()->route('maintenance.index')->with('success', 'Data Maintenance berhasil ditambahkan.');
    }

    public function show($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        return response()->json($maintenance);
    }


    public function update(Request $request, $id)
    {
        $maintenance = Maintenance::findOrFail($id);

        $validated = $request->validate([
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
        $maintenance->delete();

        return redirect()->route('maintenance.index')->with('success', 'Data Maintenance berhasil dihapus.');
    }
}
