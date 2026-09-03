<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller {
    public function index() {
        $assets = Assets::with(['item.category'])->latest()->paginate(10);
        return view('assets.index', compact('assets'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'kode_asset' => 'required|unique:assets,kode_asset',
            'nama_asset' => 'required|string|max:255',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'masa_manfaat' => 'required|integer',
            'harga_perolehan' => 'required|numeric',
            'status' => 'required|in:Tersedia,Dipinjam,Maintenance,Rusak'
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('assets-foto', 'public');
        }

        $validated['nilai_penyusutan_terakhir'] = $validated['harga_perolehan'];

        Assets::create($validated);

        return redirect()->route('assets.index')->with('success', 'Asset berhasil ditambahkan.');
    }
}
