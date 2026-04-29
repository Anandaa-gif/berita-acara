<?php

namespace App\Http\Controllers;

use App\Models\Backbone;
use Illuminate\Http\Request;

class BackboneController extends Controller
{
    public function index()
    {
        $backbones = Backbone::latest()->paginate(10);
        return view('backbone.index', compact('backbones'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lokasi' => 'required|string|max:255',
            'tiang_odp' => 'required|string|max:255',
            'action' => 'required|string',
            'titik_koordinat' => 'required|string|max:255',
            'ratio' => 'required|string|max:255',
            'splitter' => 'required|string|max:255',
            'redaman_input' => 'required|string|max:255',
            'redaman_output' => 'required|string|max:255',
            'tehnisi_1' => 'required|string|max:255',
            'tehnisi_2' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        Backbone::create($validated);

        return redirect()->route('backbone.index')->with('success', 'Data Backbone berhasil ditambahkan.');
    }

    public function show($id)
    {
        $backbone = Backbone::findOrFail($id);
        return response()->json($backbone);
    }

    public function update(Request $request, $id)
    {
        $backbone = Backbone::findOrFail($id);

        $validated = $request->validate([
            'lokasi' => 'required|string|max:255',
            'tiang_odp' => 'required|string|max:255',
            'action' => 'required|string',
            'titik_koordinat' => 'required|string|max:255',
            'ratio' => 'required|string|max:255',
            'splitter' => 'required|string|max:255',
            'redaman_input' => 'required|string|max:255',
            'redaman_output' => 'required|string|max:255',
            'tehnisi_1' => 'required|string|max:255',
            'tehnisi_2' => 'required|string|max:255',
            'keterangan' => 'required|string',
        ]);

        $backbone->update($validated);

        return redirect()->route('backbone.index')->with('success', 'Data Backbone berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $backbone = Backbone::findOrFail($id);
        $backbone->delete();

        return redirect()->route('backbone.index')->with('success', 'Data Backbone berhasil dihapus.');
    }
}
