@extends('layouts.app')

@section('content')
@include('components.page-styles')

<div class="pg-wrap">
    <div class="pg-header">
        <div class="pg-title">
            <div class="icon" style="background: linear-gradient(135deg, #4f46e5 0%, #3b82f6 100%)">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
            <div>
                <h1>Laporan Data Guru</h1>
                <p>Rekapitulasi data seluruh staf pengajar/piket</p>
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
            <div class="ms-icon i"><i class="fas fa-users"></i></div>
            <div>
                <div class="ms-val">{{ $totalGuru }}</div>
                <div class="ms-lbl">Total Guru</div>
            </div>
        </div>
        @foreach($guruPerJabatan->take(3) as $pj)
        <div class="ms-card">
            <div class="ms-icon s"><i class="fas fa-user-tag"></i></div>
            <div>
                <div class="ms-val">{{ $pj->total }}</div>
                <div class="ms-lbl">{{ $pj->jabatan }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="tbl-card">
        <div class="tbl-head">
            <h5><i class="fas fa-table"></i> Daftar Guru</h5>
        </div>
        <div style="overflow-x:auto">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIP</th>
                        <th>Nama Lengkap</th>
                        <th>Jabatan</th>
                        <th>No. Telp</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guru as $i => $g)
                    <tr>
                        <td>{{ $guru->firstItem() + $i }}</td>
                        <td><span class="tag neu">{{ $g->nip ?? '-' }}</span></td>
                        <td>
                            <div style="display:flex;align-items:center;gap:.6rem">
                                <div class="av" style="background:linear-gradient(135deg,#4f46e5,#3b82f6)">
                                    {{ strtoupper(substr($g->nama??'?',0,1)) }}
                                </div>
                                <span style="font-weight:600;color:#2d3748">{{ $g->nama??'-' }}</span>
                            </div>
                        </td>
                        <td><span class="tag p">{{ $g->jabatan??'-' }}</span></td>
                        <td>{{ $g->no_telp ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-chalkboard-teacher"></i>
                                <h5>Belum ada data guru</h5>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="tbl-foot">
            {{ $guru->links() }}
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
