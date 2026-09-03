<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Asset Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-4">
        <!-- Header & Navigasi -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Dashboard Asset Management</h2>
            <div>
                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary btn-sm">Kategori</a>
                <a href="{{ route('items.index') }}" class="btn btn-outline-secondary btn-sm">Barang</a>
                <a href="{{ route('assets.index') }}" class="btn btn-primary btn-sm">Data Asset</a>
                <a href="{{ route('submissions.index') }}" class="btn btn-outline-secondary btn-sm">Pengajuan</a>
                <a href="{{ route('depreciations.index') }}" class="btn btn-outline-secondary btn-sm">Penyusutan</a>
            </div>
        </div>
        <hr>

        <!-- Kotak Statistik (Cards) -->
        <div class="row text-white mb-4">
            <div class="col-md-3 mb-3">
                <div class="card bg-primary p-3 shadow-sm">
                    <h5>Total Asset</h5>
                    <h3>{{ $totalAsset }}</h3>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-success p-3 shadow-sm">
                    <h5>Total Barang</h5>
                    <h3>{{ $totalBarang }}</h3>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-warning text-dark p-3 shadow-sm">
                    <h5>Total Kategori</h5>
                    <h3>{{ $totalKategori }}</h3>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-danger p-3 shadow-sm">
                    <h5>Pengajuan Pending</h5>
                    <h3>{{ $pendingPengajuan }}</h3>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card bg-secondary p-3 shadow-sm">
                    <h5>Data Penyusutan</h5>
                    <h3>{{ $totalPenyusutan }}</h3>
                </div>
            </div>
        </div>

        <!-- Tabel Asset Terbaru -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">5 Asset Terbaru Ditambahkan</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Asset</th>
                            <th>Nama Asset</th>
                            <th>Kategori & Barang</th>
                            <th>Status</th>
                            <th>Harga Perolehan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestAssets as $index => $asset)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $asset->kode_asset }}</td>
                            <td>{{ $asset->nama_asset }}</td>
                            <td>{{ $asset->item->category->nama_kategori ?? '-' }} / {{ $asset->item->nama_barang ?? '-' }}</td>
                            <td>
                                @php
                                    $badge = [
                                        'Tersedia' => 'success',
                                        'Dipinjam' => 'primary',
                                        'Maintenance' => 'warning text-dark',
                                        'Rusak' => 'danger'
                                    ][$asset->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $badge }}">{{ $asset->status }}</span>
                            </td>
                            <td>Rp {{ number_format($asset->harga_perolehan, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data asset.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>