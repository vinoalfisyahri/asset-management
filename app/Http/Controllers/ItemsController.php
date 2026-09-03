<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Categories;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Items::with('category')->latest()->paginate(10);
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $categories = Categories::all();
        return view('items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        Items::create($validated);

        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit(Items $item)
    {
        $categories = Categories::all();
        return view('items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Items $item)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        $item->update($validated);

        return redirect()->route('items.index')->with('success', 'Barang berhasil diupdate!');
    }

    public function destroy(Items $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus!');
    }
}