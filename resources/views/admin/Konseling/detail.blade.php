@extends('admin.layout')

@section('content')
<div class="container">
    <h4>📝 Detail Konseling</h4>

    <div class="card mt-3">
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200">Siswa</th>
                    <td>{{ $konseling->siswa->nama }}</td>
                </tr>
                <tr>
                    <th>Guru BK</th>
                    <td>{{ $konseling->guru->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-info text-dark">
                            {{ ucfirst($konseling->status) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Masalah</th>
                    <td>{{ $konseling->masalah }}</td>
                </tr>
                <tr>
                    <th>Solusi</th>
                    <td>{{ $konseling->solusi }}</td>
                </tr>
            </table>

            <hr>

            <h6>📚 Riwayat Konseling</h6>
            <ul>
                @forelse($konseling->riwayat as $r)
                    <li>
                        {{ $r->catatan }}
                        <small class="text-muted">
                            ({{ $r->created_at->format('d M Y') }})
                        </small>
                    </li>
                @empty
                    <li class="text-muted">Belum ada riwayat</li>
                @endforelse
            </ul>

            <a href="/admin/konseling" class="btn btn-secondary mt-3">
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
