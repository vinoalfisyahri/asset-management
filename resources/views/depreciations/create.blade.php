<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Penyusutan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-4">
        <h2>Tambah Penyusutan Baru</h2>
        <hr>

        <form action="{{ route('depreciations.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Pilih Asset</label>
                <select name="asset_id" class="form-control @error('asset_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Asset --</option>
                    @foreach($assets as $asset)
                        <option value="{{ $asset->id }}">{{ $asset->nama_asset }} ({{ $asset->kode_asset }})</option>
                    @endforeach
                </select>
                @error('asset_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tahun</label>
                <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror" value="{{ old('tahun', date('Y')) }}" required>
                @error('tahun')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nilai Penyusutan (Rp)</label>
                <input type="number" name="nilai_penyusutan" class="form-control @error('nilai_penyusutan') is-invalid @enderror" value="{{ old('nilai_penyusutan') }}" required>
                @error('nilai_penyusutan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nilai Sisa / Buku (Rp)</label>
                <input type="number" name="nilai_sisa" class="form-control @error('nilai_sisa') is-invalid @enderror" value="{{ old('nilai_sisa') }}" required>
                @error('nilai_sisa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
            <a href="{{ route('depreciations.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </form>
    </div>

</body>
</html>