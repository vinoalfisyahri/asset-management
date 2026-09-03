<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Asset</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-4">
        <h2>Daftar Asset</h2>
        <hr>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('assets.create') }}" class="btn btn-primary btn-sm">+ Tambah Asset</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama & Kode</th>
                    <th>Kategori / Barang</th>
                    <th>Masa Manfaat</th>
                    <th>Pengajuan</th>
                    <th>Penyusutan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assets as $index => $asset)
                <tr>
                    <td>{{ $assets->firstItem() + $index }}</td>
                    <td>
                        @if($asset->foto)
                            <img src="{{ asset('storage/' . $asset->foto) }}" width="50" height="50" class="img-thumbnail">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        {{ $asset->nama_asset }}<br>
                        <small class="text-muted">{{ $asset->kode_asset }}</small>
                    </td>
                    <td>
                        {{ $asset->item->category->nama_kategori ?? '-' }}<br>
                        <small class="text-muted">{{ $asset->item->nama_barang ?? '-' }}</small>
                    </td>
                    <td>{{ $asset->masa_manfaat }} Tahun</td>
                    <td>
                        {{ $asset->submissions()->where('status_pengajuan', 'Pending')->count() }} Pending
                    </td>
                    <td>Rp {{ number_format($asset->nilai_penyusutan_terakhir, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge bg-secondary">{{ $asset->status }}</span>
                    </td>
                    <td>
                        <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus asset ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">Belum ada data asset.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div>
            {{ $assets->links() }}
        </div>
    </div>

</body>
</html>