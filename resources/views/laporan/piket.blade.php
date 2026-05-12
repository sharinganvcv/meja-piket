@extends('layouts.app')

@section('content')
@include('components.page-styles')

<div class="pg-wrap">
    <div class="pg-header">
        <div class="pg-title">
            <div class="icon" style="background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%)">
                <i class="fas fa-calendar-check"></i>
            </div>
            <div>
                <h1>Laporan Aktivitas Piket</h1>
                <p>Rekapitulasi data piket harian</p>
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
            <div class="ms-icon i"><i class="fas fa-history"></i></div>
            <div>
                <div class="ms-val">{{ $totalPiket }}</div>
                <div class="ms-lbl">Total Piket</div>
            </div>
        </div>
        <div class="ms-card">
            <div class="ms-icon s"><i class="fas fa-calendar-alt"></i></div>
            <div>
                <div class="ms-val">{{ $piketBulanIni }}</div>
                <div class="ms-lbl">Bulan Ini</div>
            </div>
        </div>
    </div>

    <div class="tbl-card">
        <div class="tbl-head">
            <h5><i class="fas fa-table"></i> Log Aktivitas Piket</h5>
        </div>
        <div style="overflow-x:auto">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Guru Piket</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($piket as $i => $p)
                    <tr>
                        <td>{{ $piket->firstItem() + $i }}</td>
                        <td><span style="font-size:.85rem;color:#4a5568">{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</span></td>
                        <td>
                            <div style="display:flex;align-items:center;gap:.6rem">
                                <div class="av" style="background:linear-gradient(135deg,#10b981,#3b82f6)">
                                    {{ strtoupper(substr($p->guru->nama??'?',0,1)) }}
                                </div>
                                <span style="font-weight:600;color:#2d3748">{{ $p->guru->nama??'-' }}</span>
                            </div>
                        </td>
                        <td><span style="font-weight:600;color:#2d3748">{{ $p->siswa->nama??'-' }}</span></td>
                        <td><span class="tag p">{{ $p->siswa->kelas??'-' }}</span></td>
                        <td><span style="font-size:.83rem;color:#718096">{{ $p->keterangan ?? '-' }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fas fa-calendar-check"></i>
                                <h5>Belum ada data aktivitas piket</h5>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="tbl-foot">
            {{ $piket->links() }}
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
