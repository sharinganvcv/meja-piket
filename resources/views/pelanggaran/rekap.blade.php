@extends('layouts.app')

@section('content')
@include('components.page-styles')

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
                            <td colspan="5">
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

@endsection