<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Asset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-4">
        <h2>Tambah Asset Baru</h2>
        <hr>

        <form action="{{ route('assets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Barang & Kategori</label>
                <select name="item_id" class="form-control @error('item_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Barang --</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->nama_barang }} (Kategori: {{ $item->category->nama_kategori ?? '-' }})
                        </option>
                    @endforeach
                </select>
                @error('item_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Kode Asset</label>
                <input type="text" name="kode_asset" class="form-control @error('kode_asset') is-invalid @enderror" value="{{ $kodeOtomatis }}" readonly required>
                @error('kode_asset')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Asset</label>
                <input type="text" name="nama_asset" class="form-control @error('nama_asset') is-invalid @enderror" value="{{ old('nama_asset') }}" required>
                @error('nama_asset')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Masa Manfaat (Tahun)</label>
                <input type="number" name="masa_manfaat" class="form-control @error('masa_manfaat') is-invalid @enderror" value="{{ old('masa_manfaat') }}" required>
                @error('masa_manfaat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Harga Perolehan (Rp)</label>
                <input type="number" name="harga_perolehan" class="form-control @error('harga_perolehan') is-invalid @enderror" value="{{ old('harga_perolehan') }}" required>
                @error('harga_perolehan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Dipinjam">Dipinjam</option>
                    <option value="Maintenance">Maintenance</option>
                    <option value="Rusak">Rusak</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Asset</label>
                <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            <a href="{{ route('assets.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </form>
    </div>

</body>
</html>