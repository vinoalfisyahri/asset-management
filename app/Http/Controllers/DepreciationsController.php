<?php

namespace App\Http\Controllers;

use App\Models\Depreciations;
use App\Models\Assets;
use Illuminate\Http\Request;

class DepreciationsController extends Controller
{
    public function index()
    {
        $depreciations = Depreciations::with('asset')->latest()->paginate(10);
        return view('depreciations.index', compact('depreciations'));
    }

    public function create()
    {
        $assets = Assets::all();
        return view('depreciations.create', compact('assets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'tahun' => 'required|digits:4|integer',
            'nilai_penyusutan' => 'required|numeric',
            'nilai_sisa' => 'required|numeric'
        ]);

        Depreciations::create($validated);

        // Update nilai penyusutan terakhir di tabel assets
        $asset = Assets::find($validated['asset_id']);
        if ($asset) {
            $asset->update([
                'nilai_penyusutan_terakhir' => $validated['nilai_sisa']
            ]);
        }

        return redirect()->route('depreciations.index')->with('success', 'Data penyusutan berhasil ditambahkan!');
    }

    public function edit(Depreciations $depreciation)
    {
        $assets = Assets::all();
        return view('depreciations.edit', compact('depreciation', 'assets'));
    }

    public function update(Request $request, Depreciations $depreciation)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'tahun' => 'required|digits:4|integer',
            'nilai_penyusutan' => 'required|numeric',
            'nilai_sisa' => 'required|numeric'
        ]);

        $depreciation->update($validated);

        // Update nilai penyusutan terakhir di tabel assets
        $asset = Assets::find($validated['asset_id']);
        if ($asset) {
            $asset->update([
                'nilai_penyusutan_terakhir' => $validated['nilai_sisa']
            ]);
        }

        return redirect()->route('depreciations.index')->with('success', 'Data penyusutan berhasil diupdate!');
    }

    public function destroy(Depreciations $depreciation)
    {
        $depreciation->delete();
        return redirect()->route('depreciations.index')->with('success', 'Data penyusutan berhasil dihapus!');
    }
}