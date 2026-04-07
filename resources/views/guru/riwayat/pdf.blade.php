pddf blade <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Riwayat Konseling</title>
    <style>
    body {
        font-family: DejaVu Sans, sans-serif;
        font-size: 10px;
        color: #222;
        margin: 15px;
    }

    .header {
        text-align: center;
        margin-bottom: 20px;
    }

    .header h1 {
        margin: 0;
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .header p {
        margin: 5px 0 0;
        font-size: 12px;
        color: #555;
    }

    .line {
        border-bottom: 2px solid #333;
        margin: 12px 0 16px;
    }

    .info-table {
        width: 100%;
        margin-bottom: 16px;
        font-size: 11px;
    }

    .info-table td {
        padding: 3px 0;
    }

    .info-label {
        width: 130px;
        font-weight: bold;
    }

    .info-separator {
        width: 10px;
    }

    table.data-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 8px;
        table-layout: fixed; /* ← kunci biar ga melar */
    }

    table.data-table th {
        background-color: #e9ecef;
        border: 1px solid #555;
        padding: 6px 4px;
        text-align: center;
        font-size: 9px;
        word-wrap: break-word;
    }

    table.data-table td {
        border: 1px solid #777;
        padding: 6px 4px;
        vertical-align: top;
        font-size: 9px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .text-center {
        text-align: center;
    }

    .text-muted {
        color: #777;
        font-style: italic;
    }

    .footer-sign {
        margin-top: 40px;
        width: 100%;
    }

    .footer-sign td {
        text-align: right;
        vertical-align: top;
    }

    .signature-box {
        width: 220px;
        float: right;
        text-align: center;
    }

    .small-note {
        margin-top: 30px;
        font-size: 9px;
        color: #666;
    }
</style>
</head>
<body>

    <div class="header">
        <h1>Laporan Riwayat Konseling</h1>
        <p>Bimbingan Konseling Sekolah</p>
    </div>

    <div class="line"></div>

    <table class="info-table">
    <tr>
        <td class="info-label">Guru BK</td>
        <td class="info-separator">:</td>
        <td>{{ $guru->nama ?? '-' }}</td>
    </tr>
    <tr>
        <td class="info-label">Periode</td>
        <td class="info-separator">:</td>
        <td>
            @if(!empty($namaBulan) && $namaBulan !== 'Semua Periode')
                {{ $namaBulan }} {{ $tahun }}
            @else
                Semua Periode {{ $tahun }}
            @endif
        </td>
    </tr>
    <tr>
        <td class="info-label">Tanggal Cetak</td>
        <td class="info-separator">:</td>
            <td>{{ \Carbon\Carbon::now()->format('d M Y') }}</td>
        </tr>
        <tr>
            <td class="info-label">Total Riwayat</td>
            <td class="info-separator">:</td>
            <td>{{ $riwayat->count() }} data</td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
    <tr>
        <th width="3%">No</th>
        <th width="14%">Nama Siswa</th>
        <th width="10%">Kelas</th>
        <th width="18%">Jenis Masalah</th>
        <th width="18%">Solusi</th>
        <th width="9%">Status</th>
        <th width="18%">Catatan Terakhir</th>
        <th width="10%">Tanggal</th>
    </tr>
</thead>
        <tbody>
            @forelse($riwayat as $index => $item)
                @php
                    $catatanTerakhir = $item->riwayatKonseling->sortByDesc('tanggal')->first();
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->siswa->nama ?? '-' }} </td>
                    <td>{{ $item->siswa->kelas->nama_kelas ?? '-' }}</td>
                    <td>{{ $item->masalah ?? '-' }}</td>
                    <td>
                        @if($item->solusi)
                            {{ $item->solusi }}
                        @else
                            <span class="text-muted">Belum ada solusi</span>
                        @endif
                    </td>
                    <td class="text-center">{{ ucfirst($item->status) }}</td>
                    <td>
                        @if($catatanTerakhir)
                            {{ $catatanTerakhir->catatan }}
                        @else
                            <span class="text-muted">Belum ada catatan</span>
                        @endif
                    </td>
                    <td class="text-center">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data riwayat konseling</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table class="footer-sign">
        <tr>
            <td>
                <div class="signature-box">
                    Bandung, {{ \Carbon\Carbon::now()->format('d M Y') }}<br>
                    Guru BK
                    <br><br><br><br>
                    <strong>{{ $guru->nama ?? '-' }}</strong>
                </div>
            </td>
        </tr>
    </table>

</body>
</html>