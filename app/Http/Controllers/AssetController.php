<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Items;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller 
{
    public function index() 
    {
        $assets = Assets::with(['item.category'])->latest()->paginate(10);
        return view('assets.index', compact('assets'));
    }

    public function create() 
    {
        $items = Items::with('category')->get();

        // Generate kode asset otomatis untuk ditampilkan di form (readonly)
        $tahunBulan = date('Ym');
        $lastAsset = Assets::where('kode_asset', 'like', "AST-{$tahunBulan}-%")->latest('id')->first();
        
        if ($lastAsset) {
            $lastNumber = (int) substr($lastAsset->kode_asset, -4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }

        $kodeOtomatis = 'AST-' . $tahunBulan . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        return view('assets.create', compact('items', 'kodeOtomatis'));
    }

    public function store(Request $request) 
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'nama_asset' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'masa_manfaat' => 'required|integer',
            'harga_perolehan' => 'required|numeric',
            'status' => 'required|in:Tersedia,Dipinjam,Maintenance,Rusak'
        ]);

        // Generate ulang kode asset di store untuk keamanan data
        $tahunBulan = date('Ym');
        $lastAsset = Assets::where('kode_asset', 'like', "AST-{$tahunBulan}-%")->latest('id')->first();
        $nextNumber = $lastAsset ? ((int) substr($lastAsset->kode_asset, -4) + 1) : 1;
        
        $validated['kode_asset'] = 'AST-' . $tahunBulan . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('assets-foto', 'public');
        }

        $validated['nilai_penyusutan_terakhir'] = $validated['harga_perolehan'];

        Assets::create($validated);

        return redirect()->route('assets.index')->with('success', 'Asset berhasil ditambahkan.');
    }

    public function edit(Assets $asset) 
    {
        $items = Items::with('category')->get();
        return view('assets.edit', compact('asset', 'items'));
    }

    public function update(Request $request, Assets $asset) 
    {
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'kode_asset' => 'required|unique:assets,kode_asset,' . $asset->id,
            'nama_asset' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'masa_manfaat' => 'required|integer',
            'harga_perolehan' => 'required|numeric',
            'status' => 'required|in:Tersedia,Dipinjam,Maintenance,Rusak'
        ]);

        if ($request->hasFile('foto')) {
            if ($asset->foto && Storage::disk('public')->exists($asset->foto)) {
                Storage::disk('public')->delete($asset->foto);
            }
            $validated['foto'] = $request->file('foto')->store('assets-foto', 'public');
        }

        $asset->update($validated);

        return redirect()->route('assets.index')->with('success', 'Asset berhasil diupdate!');
    }

    public function destroy(Assets $asset) 
    {
        if ($asset->foto && Storage::disk('public')->exists($asset->foto)) {
            Storage::disk('public')->delete($asset->foto);
        }
        
        $asset->delete();

        return redirect()->route('assets.index')->with('success', 'Asset berhasil dihapus!');
    }
}