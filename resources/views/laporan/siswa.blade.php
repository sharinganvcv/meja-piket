@extends('layouts.app')

@section('content')
@include('components.page-styles')

<div class="pg-wrap">
    <div class="pg-header">
        <div class="pg-title">
            <div class="icon" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%)">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div>
                <h1>Laporan Data Siswa</h1>
                <p>Rekapitulasi data seluruh siswa</p>
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
                <div class="ms-val">{{ $totalSiswa }}</div>
                <div class="ms-lbl">Total Siswa</div>
            </div>
        </div>
        @foreach($siswaPerKelas->take(3) as $pk)
        <div class="ms-card">
            <div class="ms-icon s"><i class="fas fa-school"></i></div>
            <div>
                <div class="ms-val">{{ $pk->total }}</div>
                <div class="ms-lbl">Kelas {{ $pk->kelas }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="tbl-card">
        <div class="tbl-head">
            <h5><i class="fas fa-table"></i> Daftar Siswa</h5>
        </div>
        <div style="overflow-x:auto">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIS</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>Jenis Kelamin</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($siswa as $i => $s)
                    <tr>
                        <td>{{ $siswa->firstItem() + $i }}</td>
                        <td><span class="tag neu">{{ $s->nis }}</span></td>
                        <td>
                            <div style="display:flex;align-items:center;gap:.6rem">
                                <div class="av" style="background:linear-gradient(135deg,#10b981,#059669)">
                                    {{ strtoupper(substr($s->nama??'?',0,1)) }}
                                </div>
                                <span style="font-weight:600;color:#2d3748">{{ $s->nama??'-' }}</span>
                            </div>
                        </td>
                        <td><span class="tag p">{{ $s->kelas??'-' }}</span></td>
                        <td>{{ $s->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-state">
                                <i class="fas fa-user-graduate"></i>
                                <h5>Belum ada data siswa</h5>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="tbl-foot">
            {{ $siswa->links() }}
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
