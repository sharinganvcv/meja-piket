@extends('layouts.app')
@section('content')
@include('components.page-styles')

<div class="pg-wrap">
    {{-- PAGE HEADER (screen only) --}}
    <div class="pg-header no-print">
        <div class="pg-title">
            <div class="icon" style="background:linear-gradient(135deg,#6366f1,#a855f7)"><i class="fas fa-file-alt"></i></div>
            <div><h1>Laporan Izin Keluar</h1><p>Rekapitulasi data izin keluar siswa</p></div>
        </div>
        <div class="pg-actions">
            <button onclick="window.print()" class="btn-prim">
                <i class="fas fa-print"></i> Cetak / Simpan PDF
            </button>
        </div>
    </div>

    {{-- FILTER (screen only) --}}
    <form method="GET" action="{{ route('laporan.izin') }}" class="filter-card mb-4 no-print">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="filter-label">Bulan</label>
                <select name="bulan" class="pro-select" style="width:100%; padding:.6rem; border-radius:10px; border:2px solid #e8ecf4">
                    @foreach(range(1,12) as $m)
                    <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->translatedFormat('F') }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="filter-label">Tahun</label>
                <select name="tahun" class="pro-select" style="width:100%; padding:.6rem; border-radius:10px; border:2px solid #e8ecf4">
                    @foreach(range(now()->year - 2, now()->year + 1) as $y)
                    <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="filter-label">Status</label>
                <select name="status" class="pro-select" style="width:100%; padding:.6rem; border-radius:10px; border:2px solid #e8ecf4">
                    <option value="">Semua Status</option>
                    <option value="keluar" {{ $status == 'keluar' ? 'selected' : '' }}>Keluar</option>
                    <option value="kembali" {{ $status == 'kembali' ? 'selected' : '' }}>Kembali</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn-prim w-100 justify-content-center" style="padding:.6rem">
                    <i class="fas fa-search"></i> Tampilkan
                </button>
            </div>
        </div>
    </form>

    {{-- MINI STATS (screen only) --}}
    <div class="mini-stats no-print">
        <div class="ms-card"><div class="ms-icon i"><i class="fas fa-door-open"></i></div><div><div class="ms-val">{{ $izinBulanIni }}</div><div class="ms-lbl">Total Bulan Ini</div></div></div>
        <div class="ms-card"><div class="ms-icon s"><i class="fas fa-check-circle"></i></div><div><div class="ms-val">{{ $izinPerStatus->get('kembali', 0) }}</div><div class="ms-lbl">Sudah Kembali</div></div></div>
        <div class="ms-card"><div class="ms-icon w"><i class="fas fa-spinner"></i></div><div><div class="ms-val">{{ $izinPerStatus->get('keluar', 0) }}</div><div class="ms-lbl">Belum Kembali</div></div></div>
        <div class="ms-card"><div class="ms-icon p"><i class="fas fa-calendar"></i></div><div><div class="ms-val">{{ $totalIzin }}</div><div class="ms-lbl">Total Semua Waktu</div></div></div>
    </div>

    {{-- ======= PRINTABLE DOCUMENT ======= --}}
    <div class="tbl-card print-doc">
        {{-- KOP SEKOLAH --}}
        <div class="print-header">
            <img src="https://i.ibb.co/5b1d6f8/logo.png" alt="Logo" onerror="this.style.display='none'" style="height:70px">
            <div class="print-header-text">
                <div class="sekolah-nama">SMKN 1 CIOMAS</div>
                <div class="sekolah-sub">Sekolah Menengah Kejuruan Negeri 1 Ciomas</div>
                <div class="sekolah-alamat">Jl. Raya Ciomas, Bogor, Jawa Barat</div>
            </div>
        </div>
        <hr style="border:2px solid #2d3748; margin:0 0 8px">
        <div style="border-bottom:1px solid #2d3748; margin-bottom:16px"></div>

        {{-- JUDUL LAPORAN --}}
        <div style="text-align:center; margin-bottom:20px">
            <div style="font-size:1rem; font-weight:700; text-transform:uppercase; letter-spacing:1px">LAPORAN IZIN KELUAR SISWA</div>
            <div style="font-size:.85rem; color:#4a5568; margin-top:4px">
                Periode: {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }} {{ $tahun }}
                @if($status) — Status: {{ ucfirst($status) }} @endif
            </div>
        </div>

        {{-- TABEL DATA --}}
        <table class="print-table">
            <thead>
                <tr>
                    <th style="width:35px">No</th>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Alasan</th>
                    <th>Guru Pemberi Izin</th>
                    <th>Waktu Keluar</th>
                    <th>Waktu Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @forelse($izin as $i => $iz)
            <tr>
                <td style="text-align:center">{{ $i + 1 }}</td>
                <td><strong>{{ $iz->siswa->nama ?? '-' }}</strong></td>
                <td>{{ $iz->siswa->nis ?? '-' }}</td>
                <td>{{ $iz->siswa->kelas ?? '-' }}</td>
                <td>{{ $iz->alasan }}</td>
                <td>{{ $iz->guru->nama ?? '-' }}</td>
                <td>{{ \Carbon\Carbon::parse($iz->waktu_keluar)->format('d/m/Y H:i') }}</td>
                <td>{{ $iz->waktu_kembali ? \Carbon\Carbon::parse($iz->waktu_kembali)->format('d/m/Y H:i') : '-' }}</td>
                <td style="text-align:center">
                    <span class="print-badge {{ $iz->status === 'kembali' ? 'badge-kembali' : 'badge-keluar' }}">
                        {{ ucfirst($iz->status) }}
                    </span>
                </td>
            </tr>
            @empty
            <tr><td colspan="9" style="text-align:center;padding:20px;color:#718096">Tidak ada data izin keluar untuk periode ini.</td></tr>
            @endforelse
            </tbody>
        </table>

        {{-- REKAPITULASI --}}
        <div style="margin-top:16px; display:flex; gap:24px; font-size:.82rem">
            <div><strong>Total Data:</strong> {{ $izin->count() }} izin</div>
            <div><strong>Sudah Kembali:</strong> {{ $izinPerStatus->get('kembali', 0) }}</div>
            <div><strong>Belum Kembali:</strong> {{ $izinPerStatus->get('keluar', 0) }}</div>
        </div>

        {{-- TANDA TANGAN --}}
        <div class="ttd-box">
            <div class="ttd-item">
                <div>Mengetahui,</div>
                <div style="font-weight:600">Kepala Sekolah</div>
                <div class="ttd-space"></div>
                <div>( _________________________ )</div>
            </div>
            <div class="ttd-item">
                <div>Ciomas, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                <div style="font-weight:600">Petugas / Guru Piket</div>
                <div class="ttd-space"></div>
                <div>( _________________________ )</div>
            </div>
        </div>
    </div>
</div>

<style>
/* --- SCREEN STYLES --- */
.print-doc { padding: 1.5rem; }
.print-header { display:flex; align-items:center; gap:16px; padding-bottom:12px; }
.print-header-text { flex:1; }
.sekolah-nama { font-size:1.35rem; font-weight:800; color:#1a202c; letter-spacing:.5px; }
.sekolah-sub { font-size:.9rem; color:#4a5568; font-weight:600; }
.sekolah-alamat { font-size:.8rem; color:#718096; }

.print-table { width:100%; border-collapse:collapse; font-size:.78rem; margin-top:8px; }
.print-table th { background:#2d3748; color:#fff; padding:8px 10px; text-align:left; font-weight:600; font-size:.75rem; }
.print-table td { padding:7px 10px; border-bottom:1px solid #e2e8f0; vertical-align:top; }
.print-table tbody tr:nth-child(even) { background:#f8fafc; }
.print-table tbody tr:hover { background:#eef2ff; }

.print-badge { display:inline-block; padding:2px 8px; border-radius:20px; font-size:.72rem; font-weight:700; }
.badge-kembali { background:#d1fae5; color:#065f46; }
.badge-keluar { background:#fef3c7; color:#92400e; }

.ttd-box { display:flex; justify-content:space-between; margin-top:40px; }
.ttd-item { text-align:center; font-size:.82rem; }
.ttd-space { height:60px; }

/* --- PRINT STYLES --- */
@media print {
    .no-print, .sidebar, .navbar, .pg-header, .mini-stats, .filter-card,
    .topbar, nav, header, footer { display: none !important; }

    body, html { margin:0; padding:0; font-family: Arial, sans-serif; font-size: 11pt; }
    .main-content { margin-left: 0 !important; padding: 0 !important; }
    .pg-wrap { padding: 0 !important; }

    .print-doc {
        box-shadow: none !important;
        border: none !important;
        padding: 10mm 15mm !important;
        margin: 0 !important;
    }

    .sekolah-nama { font-size: 16pt !important; }
    .sekolah-sub { font-size: 11pt !important; }

    .print-table { font-size: 9pt !important; }
    .print-table th { background: #2d3748 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    .print-table tbody tr:nth-child(even) { background: #f8fafc !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }

    .print-badge { border: 1px solid #999 !important; }
    .badge-kembali { background: #d1fae5 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    .badge-keluar { background: #fef3c7 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }

    @page { size: A4 landscape; margin: 15mm; }
}
</style>
@endsection
