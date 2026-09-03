<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengajuan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-4">
        <h2>Edit Pengajuan</h2>
        <hr>

        <form action="{{ route('submissions.update', $submission->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Pilih Asset</label>
                <select name="asset_id" class="form-control @error('asset_id') is-invalid @enderror" required>
                    <option value="">-- Pilih Asset --</option>
                    @foreach($assets as $asset)
                        <option value="{{ $asset->id }}" {{ $submission->asset_id == $asset->id ? 'selected' : '' }}>
                            {{ $asset->nama_asset }} ({{ $asset->kode_asset }})
                        </option>
                    @endforeach
                </select>
                @error('asset_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Pengaju</label>
                <input type="text" name="nama_pengaju" class="form-control @error('nama_pengaju') is-invalid @enderror" value="{{ old('nama_pengaju', $submission->nama_pengaju) }}" required>
                @error('nama_pengaju')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Pengajuan</label>
                <input type="date" name="tanggal_pengajuan" class="form-control @error('tanggal_pengajuan') is-invalid @enderror" value="{{ old('tanggal_pengajuan', $submission->tanggal_pengajuan) }}" required>
                @error('tanggal_pengajuan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Status Pengajuan</label>
                <select name="status_pengajuan" class="form-control @error('status_pengajuan') is-invalid @enderror" required>
                    <option value="Pending" {{ $submission->status_pengajuan == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Disetujui" {{ $submission->status_pengajuan == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="Ditolak" {{ $submission->status_pengajuan == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                @error('status_pengajuan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Keperluan</label>
                <textarea name="keperluan" class="form-control @error('keperluan') is-invalid @enderror" rows="3" required>{{ old('keperluan', $submission->keperluan) }}</textarea>
                @error('keperluan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-sm">Update</button>
            <a href="{{ route('submissions.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
        </form>
    </div>

</body>
</html>