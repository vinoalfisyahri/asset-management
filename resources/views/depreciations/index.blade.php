<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Penyusutan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-4">
        <h2>Riwayat Penyusutan Asset</h2>
        <hr>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('depreciations.create') }}" class="btn btn-primary btn-sm">+ Tambah Penyusutan</a>
            <a href="{{ route('assets.index') }}" class="btn btn-secondary btn-sm">Kembali ke Asset</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Asset</th>
                    <th>Tahun</th>
                    <th>Nilai Penyusutan</th>
                    <th>Nilai Sisa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($depreciations as $index => $depreciation)
                <tr>
                    <td>{{ $depreciations->firstItem() + $index }}</td>
                    <td>{{ $depreciation->asset->nama_asset ?? '-' }} <br><small class="text-muted">{{ $depreciation->asset->kode_asset ?? '' }}</small></td>
                    <td>{{ $depreciation->tahun }}</td>
                    <td>Rp {{ number_format($depreciation->nilai_penyusutan, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($depreciation->nilai_sisa, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('depreciations.destroy', $depreciation->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data penyusutan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data penyusutan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div>
            {{ $depreciations->links() }}
        </div>
    </div>

</body>
</html>