@extends('layouts.app')

@section('content')
@include('components.page-styles')

{{-- ===== PRINT-SPECIFIC STYLES ===== --}}
<style>
/* ---------- PRINT DOCUMENT (hidden on screen, shown on print) ---------- */
.print-document { display: none; }

@media print {
    /* Hide everything from screen layout */
    .pg-wrap,
    .sidebar,
    .navbar,
    nav,
    header,
    footer,
    .pg-actions,
    .filter-box { display: none !important; }

    /* Show only the print document */
    .print-document {
        display: block !important;
        position: fixed;
        top: 0; left: 0;
        width: 100%;
        z-index: 99999;
        background: #fff;
        padding: 0;
        margin: 0;
    }

    /* Reset page */
    * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
    body {
        background: #fff !important;
        margin: 0 !important;
        padding: 0 !important;
        font-family: 'Segoe UI', 'Arial', sans-serif !important;
        font-size: 11pt !important;
        color: #000 !important;
    }
    .main-content { margin: 0 !important; padding: 0 !important; width: 100% !important; max-width: 100% !important; }
    .content-wrapper, .container-fluid, .container { margin: 0 !important; padding: 0 !important; width: 100% !important; max-width: 100% !important; }

    @page {
        size: A4 portrait;
        margin: 15mm 15mm 20mm 15mm;
    }
}

/* ---------- Print Document Inner Styles ---------- */
.print-doc-inner {
    font-family: 'Segoe UI', 'Arial', sans-serif;
    color: #1a1a1a;
    line-height: 1.5;
}

/* KOP SURAT */
.print-kop {
    display: flex;
    align-items: center;
    gap: 16px;
    padding-bottom: 12px;
    border-bottom: 3px double #222;
    margin-bottom: 24px;
}
.print-kop-logo {
    width: 64px;
    height: 64px;
    flex-shrink: 0;
}
.print-kop-logo img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}
.print-kop-text {
    flex: 1;
    text-align: center;
}
.print-kop-text .school-name {
    font-size: 16pt;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    color: #000;
    margin: 0;
}
.print-kop-text .school-address {
    font-size: 9pt;
    color: #333;
    margin: 2px 0 0 0;
}

/* TITLE */
.print-title {
    text-align: center;
    margin: 20px 0;
}
.print-title h2 {
    font-size: 14pt;
    font-weight: 700;
    text-transform: uppercase;
    text-decoration: underline;
    letter-spacing: 0.5px;
    margin: 0 0 4px 0;
    color: #000;
}
.print-title p {
    font-size: 10pt;
    color: #444;
    margin: 0;
}

/* SUMMARY BOX */
.print-summary {
    display: flex;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}
.print-summary-item {
    flex: 1;
    min-width: 120px;
    background: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 10px 14px;
    text-align: center;
}
.print-summary-item .sum-val {
    font-size: 18pt;
    font-weight: 800;
    color: #000;
    display: block;
}
.print-summary-item .sum-lbl {
    font-size: 8pt;
    font-weight: 600;
    text-transform: uppercase;
    color: #555;
    letter-spacing: 0.3px;
}

/* TABLE */
.print-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 24px;
    font-size: 10pt;
}
.print-table thead th {
    background: #2d3748 !important;
    color: #fff !important;
    font-weight: 700;
    font-size: 9pt;
    text-transform: uppercase;
    letter-spacing: 0.3px;
    padding: 10px 12px;
    border: 1px solid #2d3748;
    text-align: left;
}
.print-table thead th.center { text-align: center; }
.print-table tbody td {
    padding: 8px 12px;
    border: 1px solid #ccc;
    vertical-align: middle;
    color: #1a1a1a;
}
.print-table tbody tr:nth-child(even) {
    background: #f8f9fa !important;
}
.print-table tbody tr:hover {
    background: #edf2f7 !important;
}
.print-table .col-no { width: 40px; text-align: center; font-weight: 600; }
.print-table .col-center { text-align: center; }

/* STATUS BADGES FOR PRINT */
.print-status {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 4px;
    font-size: 9pt;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}
.print-status.good { background: #c6f6d5 !important; color: #22543d !important; border: 1px solid #9ae6b4; }
.print-status.warn { background: #fefcbf !important; color: #744210 !important; border: 1px solid #f6e05e; }
.print-status.bad  { background: #fed7d7 !important; color: #742a2a !important; border: 1px solid #feb2b2; }

/* FOOTER */
.print-footer {
    margin-top: 32px;
    display: flex;
    justify-content: flex-end;
}
.print-signature {
    text-align: center;
    min-width: 200px;
}
.print-signature .sig-city {
    font-size: 10pt;
    color: #333;
    margin: 0 0 4px 0;
}
.print-signature .sig-role {
    font-size: 10pt;
    font-weight: 600;
    color: #000;
    margin: 0;
}
.print-signature .sig-space {
    height: 64px;
}
.print-signature .sig-line {
    border-top: 1px solid #000;
    padding-top: 4px;
    font-size: 10pt;
    font-weight: 700;
    color: #000;
}

/* NOTES */
.print-notes {
    margin-top: 20px;
    font-size: 9pt;
    color: #555;
    border-top: 1px solid #ddd;
    padding-top: 10px;
}
.print-notes strong { color: #222; }
.print-notes ul {
    margin: 4px 0 0 16px;
    padding: 0;
}
.print-notes li { margin-bottom: 2px; }
</style>

{{-- ===== SCREEN LAYOUT (normal web view) ===== --}}
<div class="pg-wrap">
    <!-- Page Header -->
    <div class="pg-header">
        <div class="pg-title">
            <div class="icon" style="background:linear-gradient(135deg,#f5576c,#f093fb)"><i class="fas fa-exclamation-triangle"></i></div>
            <div>
                <h1>Rekap Pelanggaran</h1>
                <p>Data total pelanggaran dan poin setiap siswa</p>
            </div>
        </div>
        <div class="pg-actions">
            @if(auth()->user()->role === 'guru')
                <a href="{{ route('pelanggaran.create') }}" class="btn-prim">
                    <i class="fas fa-plus"></i> Tambah Pelanggaran
                </a>
            @endif
            <button class="btn-sec" onclick="window.print()">
                <i class="fas fa-print"></i> Cetak PDF
            </button>
            <a href="{{ route('pelanggaran.index') }}" class="btn-sec">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="mini-stats">
        <div class="ms-card">
            <div class="ms-icon p"><i class="fas fa-users"></i></div>
            <div>
                <div class="ms-val">{{ $rekap->count() }}</div>
                <div class="ms-lbl">Total Siswa</div>
            </div>
        </div>
        <div class="ms-card">
            <div class="ms-icon w"><i class="fas fa-exclamation-circle"></i></div>
            <div>
                <div class="ms-val">{{ $rekap->sum('jumlah_pelanggaran') }}</div>
                <div class="ms-lbl">Total Pelanggaran</div>
            </div>
        </div>
        <div class="ms-card">
            <div class="ms-icon d"><i class="fas fa-chart-line"></i></div>
            <div>
                <div class="ms-val">{{ number_format($rekap->avg('total_poin'), 1) }}</div>
                <div class="ms-lbl">Rata-rata Poin</div>
            </div>
        </div>
        <div class="ms-card">
            <div class="ms-icon s"><i class="fas fa-trophy"></i></div>
            <div>
                <div class="ms-val">{{ $rekap->max('total_poin') ?? 0 }}</div>
                <div class="ms-lbl">Poin Tertinggi</div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="tbl-card">
        <div class="tbl-head">
            <h5><i class="fas fa-table"></i> Data Rekap Pelanggaran</h5>
        </div>
        <div style="overflow-x:auto">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th style="text-align:center;">Jumlah Pelanggaran</th>
                        <th style="text-align:center;">Total Poin</th>
                        <th style="text-align:center;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rekap as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div style="display:flex;align-items:center;gap:.6rem">
                                    <div class="av" style="background:linear-gradient(135deg,#f5576c,#f093fb)">
                                        {{ strtoupper(substr($item->siswa->nama ?? '?',0,1)) }}
                                    </div>
                                    <span style="font-weight:600;color:#2d3748">{{ $item->siswa->nama ?? '-' }}</span>
                                </div>
                            </td>
                            <td><span class="tag p">{{ $item->siswa->kelas ?? '-' }}</span></td>
                            <td style="text-align:center;">
                                <span class="tag w">{{ $item->jumlah_pelanggaran }} Kali</span>
                            </td>
                            <td style="text-align:center;">
                                <span class="tag d">{{ $item->total_poin }} Poin</span>
                            </td>
                            <td style="text-align:center;">
                                @if($item->total_poin > 15)
                                    <span class="tag d">Bermasalah</span>
                                @elseif($item->total_poin >= 10)
                                    <span class="tag w">Peringatan</span>
                                @else
                                    <span class="tag s">Baik</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <h5>Tidak ada data pelanggaran</h5>
                                    <p>Silakan tambahkan data pelanggaran terlebih dahulu</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ===== PRINT-ONLY DOCUMENT ===== --}}
<div class="print-document">
    <div class="print-doc-inner">

        {{-- KOP SURAT --}}
        <div class="print-kop">
            <div class="print-kop-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'">
            </div>
            <div class="print-kop-text">
                <p class="school-name">SMK Negeri 1 CIOMAS</p>
                <p class="school-address">Jln. Raya laladon 16611 Bogor West Java</p>
                <p class="school-address">Telp: +62 251 8631261 | Email: info@smkn1contoh.sch.id</p>
            </div>
            <div class="print-kop-logo">
                <img src="{{ asset('images/logo-tut.png') }}" alt="Logo 2" onerror="this.style.display='none'">
            </div>
        </div>

        {{-- JUDUL DOKUMEN --}}
        <div class="print-title">
            <h2>Rekap Data Pelanggaran Siswa</h2>
            <p>Tahun Ajaran {{ date('Y') }}/{{ date('Y') + 1 }} &mdash; Dicetak pada: {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y, HH:mm') }} WIB</p>
        </div>

        {{-- RINGKASAN --}}
        <div class="print-summary">
            <div class="print-summary-item">
                <span class="sum-val">{{ $rekap->count() }}</span>
                <span class="sum-lbl">Total Siswa</span>
            </div>
            <div class="print-summary-item">
                <span class="sum-val">{{ $rekap->sum('jumlah_pelanggaran') }}</span>
                <span class="sum-lbl">Total Pelanggaran</span>
            </div>
            <div class="print-summary-item">
                <span class="sum-val">{{ number_format($rekap->avg('total_poin'), 1) }}</span>
                <span class="sum-lbl">Rata-rata Poin</span>
            </div>
            <div class="print-summary-item">
                <span class="sum-val">{{ $rekap->max('total_poin') ?? 0 }}</span>
                <span class="sum-lbl">Poin Tertinggi</span>
            </div>
        </div>

        {{-- TABEL DATA --}}
        <table class="print-table">
            <thead>
                <tr>
                    <th class="center" style="width:40px;">No</th>
                    <th>Nama Siswa</th>
                    <th>Kelas</th>
                    <th class="center">Jumlah Pelanggaran</th>
                    <th class="center">Total Poin</th>
                    <th class="center">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rekap as $index => $item)
                    <tr>
                        <td class="col-no">{{ $index + 1 }}</td>
                        <td style="font-weight:600;">{{ $item->siswa->nama ?? '-' }}</td>
                        <td>{{ $item->siswa->kelas ?? '-' }}</td>
                        <td class="col-center">{{ $item->jumlah_pelanggaran }} Kali</td>
                        <td class="col-center">{{ $item->total_poin }} Poin</td>
                        <td class="col-center">
                            @if($item->total_poin > 15)
                                <span class="print-status bad">Bermasalah</span>
                            @elseif($item->total_poin >= 10)
                                <span class="print-status warn">Peringatan</span>
                            @else
                                <span class="print-status good">Baik</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:24px;color:#888;">Tidak ada data pelanggaran</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- KETERANGAN STATUS --}}
        <div class="print-notes">
            <strong>Keterangan Status:</strong>
            <ul>
                <li><strong>Baik</strong> — Poin pelanggaran di bawah 10</li>
                <li><strong>Peringatan</strong> — Poin pelanggaran antara 10 s/d 15</li>
                <li><strong>Bermasalah</strong> — Poin pelanggaran lebih dari 15</li>
            </ul>
        </div>

        {{-- TANDA TANGAN --}}
        <div class="print-footer">
            <div class="print-signature">
                <p class="sig-city">Kota Contoh, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</p>
                <p class="sig-role">Kepala Sekolah</p>
                <div class="sig-space"></div>
                <div class="sig-line">( ________________________ )</div>
                <p style="font-size:9pt;color:#555;margin-top:2px;">NIP. ________________________</p>
            </div>
        </div>
    </div>
</div>

@endsection