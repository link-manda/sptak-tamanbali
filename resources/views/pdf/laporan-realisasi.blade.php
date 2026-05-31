<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Realisasi Kegiatan {{ $tahun }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1a1a1a; }
        .header { text-align: center; border-bottom: 3px solid #00236f; padding-bottom: 12px; margin-bottom: 18px; }
        .header h1 { font-size: 18px; color: #00236f; margin-bottom: 2px; }
        .header h2 { font-size: 13px; font-weight: normal; color: #444; }
        .header p { font-size: 10px; color: #666; margin-top: 4px; }
        .meta { width: 100%; margin-bottom: 14px; font-size: 10px; color: #555; }
        .meta td { padding: 1px 0; }
        .meta .right { text-align: right; }
        table.data { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        table.data th { background: #00236f; color: #fff; text-align: left; padding: 7px 8px; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px; }
        table.data th.right, table.data td.right { text-align: right; }
        table.data td { padding: 6px 8px; border-bottom: 1px solid #e2e8f0; vertical-align: top; }
        table.data tr:nth-child(even) td { background: #f6f8fc; }
        .ket { font-weight: bold; color: #00236f; }
        .tgl { font-size: 9px; color: #888; }
        .kat { font-style: italic; color: #555; }
        .masuk { color: #15803d; font-weight: bold; }
        .keluar { color: #b91c1c; font-weight: bold; }
        .summary { width: 100%; border-collapse: collapse; margin-top: 4px; }
        .summary td { padding: 7px 8px; font-size: 11px; }
        .summary .label { color: #555; }
        .summary .val { text-align: right; font-weight: bold; }
        .summary .total td { border-top: 2px solid #00236f; font-size: 13px; color: #00236f; font-weight: bold; }
        .empty { text-align: center; padding: 30px; color: #888; font-style: italic; }
        .footer { margin-top: 28px; text-align: right; font-size: 10px; color: #555; }
        .footer .ttd { margin-top: 50px; font-weight: bold; color: #1a1a1a; }
    </style>
</head>
<body>
    <div class="header">
        <h1>DESA ADAT TAMANBALI</h1>
        <h2>Laporan Realisasi Kegiatan</h2>
        <p>Kecamatan Bangli, Kabupaten Bangli &mdash; Tahun {{ $tahun }}</p>
    </div>

    <table class="meta">
        <tr>
            <td>Periode Laporan: Tahun {{ $tahun }}</td>
            <td class="right">Jumlah Transaksi: {{ $riwayatAnggaran->count() }}</td>
        </tr>
    </table>

    <table class="data">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 45%;">Keterangan Kegiatan</th>
                <th style="width: 25%;">Kategori</th>
                <th class="right" style="width: 25%;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($riwayatAnggaran as $i => $row)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>
                        <span class="ket">{{ $row->keterangan }}</span><br>
                        <span class="tgl">{{ \Carbon\Carbon::parse($row->tanggal_transaksi)->translatedFormat('d M Y') }}</span>
                    </td>
                    <td class="kat">{{ $row->kategori->nama_kategori ?? '-' }}</td>
                    <td class="right {{ $row->jenis === 'pemasukan' ? 'masuk' : 'keluar' }}">
                        {{ $row->jenis === 'pemasukan' ? '+' : '-' }} Rp {{ number_format($row->nominal, 0, ',', '.') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="empty">Belum ada data realisasi untuk tahun {{ $tahun }}.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($riwayatAnggaran->isNotEmpty())
        <table class="summary">
            <tr>
                <td class="label">Total Pemasukan</td>
                <td class="val masuk">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td class="label">Total Pengeluaran</td>
                <td class="val keluar">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
            <tr class="total">
                <td>Saldo Realisasi</td>
                <td class="val">Rp {{ number_format($saldo, 0, ',', '.') }}</td>
            </tr>
        </table>
    @endif

    <div class="footer">
        <p>Dicetak pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WITA</p>
        <p class="ttd">Prajuru Desa Adat Tamanbali</p>
    </div>
</body>
</html>
