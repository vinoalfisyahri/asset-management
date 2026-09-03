<?php

namespace App\Http\Controllers;

use App\Models\Submissions;
use App\Models\Assets;
use Illuminate\Http\Request;

class SubmissionsController extends Controller
{
    public function index()
    {
        $submissions = Submissions::with('asset')->latest()->paginate(10);
        return view('submissions.index', compact('submissions'));
    }

    public function create()
    {
        $assets = Assets::all();
        return view('submissions.create', compact('assets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'nama_pengaju' => 'required|string|max:255',
            'tanggal_pengajuan' => 'required|date',
            'status_pengajuan' => 'required|in:Pending,Disetujui,Ditolak',
            'keperluan' => 'required|string'
        ]);

        Submissions::create($validated);

        return redirect()->route('submissions.index')->with('success', 'Pengajuan berhasil ditambahkan!');
    }

    public function edit(Submissions $submission)
    {
        $assets = Assets::all();
        return view('submissions.edit', compact('submission', 'assets'));
    }

    public function update(Request $request, Submissions $submission)
    {
        $validated = $request->validate([
            'asset_id' => 'required|exists:assets,id',
            'nama_pengaju' => 'required|string|max:255',
            'tanggal_pengajuan' => 'required|date',
            'status_pengajuan' => 'required|in:Pending,Disetujui,Ditolak',
            'keperluan' => 'required|string'
        ]);

        $submission->update($validated);

        return redirect()->route('submissions.index')->with('success', 'Pengajuan berhasil diupdate!');
    }

    public function destroy(Submissions $submission)
    {
        $submission->delete();
        return redirect()->route('submissions.index')->with('success', 'Pengajuan berhasil dihapus!');
    }
}