@extends('layouts.app')

@section('content')
@include('components.page-styles')

<div class="pg-wrap">
    <div class="pg-header">
        <div class="pg-title">
            <div class="icon" style="background: linear-gradient(135deg, #f43f5e 0%, #fb923c 100%)">
                <i class="fas fa-file-invoice"></i>
            </div>
            <div>
                <h1>Laporan Keterlambatan</h1>
                <p>Rekapitulasi data siswa terlambat</p>
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
            <div class="ms-icon i"><i class="fas fa-clock"></i></div>
            <div>
                <div class="ms-val">{{ $totalKeterlambatan }}</div>
                <div class="ms-lbl">Total Terlambat</div>
            </div>
        </div>
        <div class="ms-card">
            <div class="ms-icon w"><i class="fas fa-calendar-day"></i></div>
            <div>
                <div class="ms-val">{{ $keterlambatanBulanIni }}</div>
                <div class="ms-lbl">Bulan Ini</div>
            </div>
        </div>
        <div class="ms-card">
            <div class="ms-icon s"><i class="fas fa-hourglass-half"></i></div>
            <div>
                <div class="ms-val">{{ round($rerataDurasi ?? 0, 1) }}</div>
                <div class="ms-lbl">Rerata Menit</div>
            </div>
        </div>
    </div>

    <div class="tbl-card">
        <div class="tbl-head">
            <h5><i class="fas fa-table"></i> Data Keterlambatan</h5>
        </div>
        <div style="overflow-x:auto">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Waktu Datang</th>
                        <th>Durasi</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($keterlambatan as $i => $kt)
                    <tr>
                        <td>{{ $keterlambatan->firstItem() + $i }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:.6rem">
                                <div class="av" style="background:linear-gradient(135deg,#f43f5e,#fb923c)">
                                    {{ strtoupper(substr($kt->siswa->nama??'?',0,1)) }}
                                </div>
                                <span style="font-weight:600;color:#2d3748">{{ $kt->siswa->nama??'-' }}</span>
                            </div>
                        </td>
                        <td><span class="tag p">{{ $kt->siswa->kelas??'-' }}</span></td>
                        <td><span style="font-size:.83rem;color:#4a5568">{{ \Carbon\Carbon::parse($kt->waktu_datang)->format('d M Y H:i') }}</span></td>
                        <td><span class="tag w">{{ $kt->durasi }} Menit</span></td>
                        <td><span style="font-size:.83rem;color:#718096">{{ $kt->keterangan ?? '-' }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fas fa-clock"></i>
                                <h5>Belum ada data laporan</h5>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="tbl-foot">
            {{ $keterlambatan->links() }}
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
