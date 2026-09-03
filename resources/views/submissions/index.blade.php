<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengajuan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-4">
        <h2>Daftar Pengajuan Asset</h2>
        <hr>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('submissions.create') }}" class="btn btn-primary btn-sm">+ Tambah Pengajuan</a>
            <a href="{{ route('assets.index') }}" class="btn btn-secondary btn-sm">Kembali ke Asset</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Asset</th>
                    <th>Nama Pengaju</th>
                    <th>Tanggal</th>
                    <th>Keperluan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($submissions as $index => $submission)
                <tr>
                    <td>{{ $submissions->firstItem() + $index }}</td>
                    <td>{{ $submission->asset->nama_asset ?? '-' }} <br><small class="text-muted">{{ $submission->asset->kode_asset ?? '' }}</small></td>
                    <td>{{ $submission->nama_pengaju }}</td>
                    <td>{{ $submission->tanggal_pengajuan }}</td>
                    <td>{{ $submission->keperluan }}</td>
                    <td>
                        @php
                            $badge = [
                                'Pending' => 'warning text-dark',
                                'Disetujui' => 'success',
                                'Ditolak' => 'danger'
                            ][$submission->status_pengajuan] ?? 'secondary';
                        @endphp
                        <span class="badge bg-{{ $badge }}">{{ $submission->status_pengajuan }}</span>
                    </td>
                    <td>
                        <a href="{{ route('submissions.edit', $submission->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('submissions.destroy', $submission->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus pengajuan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Belum ada data pengajuan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div>
            {{ $submissions->links() }}
        </div>
    </div>

</body>
</html>