<?php

namespace App\Http\Controllers;

use App\Models\Assets;
use App\Models\Categories;
use App\Models\Items;
use App\Models\Submissions;
use App\Models\Depreciations;

class HomeController extends Controller
{
    public function index()
    {
        $totalAsset = Assets::count();
        $totalKategori = Categories::count();
        $totalBarang = Items::count();
        $pendingPengajuan = Submissions::where('status_pengajuan', 'Pending')->count();
        $totalPenyusutan = Depreciations::count(); // Atau bisa pakai sum('nilai_penyusutan') kalau mau total nominalnya
        
        $latestAssets = Assets::with(['item.category'])->latest()->take(5)->get();

        return view('home', compact(
            'totalAsset', 
            'totalKategori', 
            'totalBarang', 
            'pendingPengajuan', 
            'totalPenyusutan',
            'latestAssets'
        ));
    }
}