@extends('layouts.app')

@section('content')
@include('components.page-styles')

<div class="pg-wrap">
    <div class="pg-header">
        <div class="pg-title">
            <div class="icon" style="background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%)">
                <i class="fas fa-file-medical-alt"></i>
            </div>
            <div>
                <h1>Laporan Pelanggaran</h1>
                <p>Rekapitulasi data pelanggaran siswa</p>
            </div>
        </div>
        <div class="pg-actions">
            <button onclick="window.print()" class="btn-prim">
                <i class="fas fa-print"></i> Cetak Laporan
            </button>
        </div>
    </div>

    <div class="mini-stats">
        <div class="ms-card">
            <div class="ms-icon i"><i class="fas fa-exclamation-triangle"></i></div>
            <div>
                <div class="ms-val">{{ $totalPelanggaran }}</div>
                <div class="ms-lbl">Total Pelanggaran</div>
            </div>
        </div>
        <div class="ms-card">
            <div class="ms-icon w"><i class="fas fa-calendar-minus"></i></div>
            <div>
                <div class="ms-val">{{ $pelanggaranBulanIni }}</div>
                <div class="ms-lbl">Bulan Ini</div>
            </div>
        </div>
        <div class="ms-card">
            <div class="ms-icon s"><i class="fas fa-star-half-alt"></i></div>
            <div>
                <div class="ms-val">{{ $totalPoin }}</div>
                <div class="ms-lbl">Total Poin</div>
            </div>
        </div>
    </div>

    <div class="tbl-card">
        <div class="tbl-head">
            <h5><i class="fas fa-table"></i> Data Pelanggaran</h5>
        </div>
        <div style="overflow-x:auto">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Poin</th>
                        <th>Sanksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggaran as $i => $pl)
                    <tr>
                        <td>{{ $pelanggaran->firstItem() + $i }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:.6rem">
                                <div class="av" style="background:linear-gradient(135deg,#ef4444,#b91c1c)">
                                    {{ strtoupper(substr($pl->siswa->nama??'?',0,1)) }}
                                </div>
                                <span style="font-weight:600;color:#2d3748">{{ $pl->siswa->nama??'-' }}</span>
                            </div>
                        </td>
                        <td><span class="tag p">{{ $pl->siswa->kelas??'-' }}</span></td>
                        <td><span style="font-size:.83rem;color:#4a5568">{{ \Carbon\Carbon::parse($pl->tanggal)->format('d M Y') }}</span></td>
                        <td><span style="font-size:.83rem;color:#718096">{{ $pl->jenis_pelanggaran }}</span></td>
                        <td><span class="tag d">{{ $pl->poin }}</span></td>
                        <td><span style="font-size:.83rem;color:#718096">{{ $pl->sanksi ?? '-' }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-exclamation-circle"></i>
                                <h5>Belum ada data laporan</h5>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="tbl-foot">
            {{ $pelanggaran->links() }}
        </div>
    </div>
</div>

<style>
    @media print {
        .sidebar, .pg-actions, .tbl-foot, .filter-box { display: none !important; }
        .main-content { margin-left: 0 !important; }
        .pg-wrap { padding: 0 !important; }
        .tbl-card { border: none !important; box-shadow: none !important; }
    }
</style>
@endsection
