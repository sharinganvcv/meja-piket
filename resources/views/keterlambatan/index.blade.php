@extends('layouts.app')
@section('content')
@include('components.page-styles')
<div class="pg-wrap">
@if(session('success'))<div class="pro-alert success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>@endif
@if(session('error'))<div class="pro-alert danger"><i class="fas fa-exclamation-circle"></i>{{ session('error') }}</div>@endif

<div class="pg-header">
    <div class="pg-title">
        <div class="icon" style="background:linear-gradient(135deg,#f5576c,#f093fb)"><i class="fas fa-clock"></i></div>
        <div><h1>Data Keterlambatan</h1><p>Pencatatan siswa yang datang terlambat</p></div>
    </div>
    <div class="pg-actions">
        <a href="{{ route('keterlambatan.create') }}" class="btn-prim"><i class="fas fa-plus"></i> Catat Keterlambatan</a>
    </div>
</div>

<div class="mini-stats">
    <div class="ms-card"><div class="ms-icon d"><i class="fas fa-clock"></i></div><div><div class="ms-val">{{ $keterlambatan->total() }}</div><div class="ms-lbl">Total Kasus</div></div></div>
    <div class="ms-card"><div class="ms-icon w"><i class="fas fa-calendar-day"></i></div><div><div class="ms-val">{{ $keterlambatan->where('waktu_datang','>=',today())->count() }}</div><div class="ms-lbl">Hari Ini</div></div></div>
    <div class="ms-card"><div class="ms-icon p"><i class="fas fa-calendar-week"></i></div><div><div class="ms-val">{{ $keterlambatan->where('waktu_datang','>=',now()->startOfWeek())->count() }}</div><div class="ms-lbl">Minggu Ini</div></div></div>
</div>

<div class="filter-box">
    <div class="filter-search"><i class="fas fa-search"></i><input type="text" id="srch" placeholder="Cari nama siswa..."></div>
    <div class="filter-info">{{ $keterlambatan->total() }} kasus</div>
</div>

<div class="tbl-card">
    <div class="tbl-head"><h5><i class="fas fa-table"></i> Daftar Keterlambatan</h5></div>
    <div style="overflow-x:auto">
    <table class="pro-table" id="tbl">
        <thead><tr><th>#</th><th>Siswa</th><th>Kelas</th><th>Waktu Datang</th><th>Keterangan</th><th>Dicatat Oleh</th><th style="text-align:center">Aksi</th></tr></thead>
        <tbody>
        @forelse($keterlambatan as $i => $k)
        <tr>
            <td>{{ $keterlambatan->firstItem() + $i }}</td>
            <td><div style="display:flex;align-items:center;gap:.6rem"><div class="av" style="background:linear-gradient(135deg,#f5576c,#f093fb)">{{ strtoupper(substr($k->siswa->nama??'?',0,1)) }}</div><span style="font-weight:600;color:#2d3748">{{ $k->siswa->nama??'-' }}</span></div></td>
            <td><span class="tag p">{{ $k->siswa->kelas??'-' }}</span></td>
            <td><span style="font-size:.85rem;color:#4a5568">{{ \Carbon\Carbon::parse($k->waktu_datang)->format('d M Y H:i') }}</span></td>
            <td><span style="color:#718096;font-size:.85rem">{{ Str::limit($k->keterangan,40) ?? '-' }}</span></td>
            <td><span style="color:#718096;font-size:.82rem">{{ $k->guru->nama??'-' }}</span></td>
            <td><div class="act-btns" style="justify-content:center">
                <a href="{{ route('keterlambatan.show', $k->id_telat) }}" class="ab view"><i class="fas fa-eye"></i></a>
                <a href="{{ route('keterlambatan.edit', $k->id_telat) }}" class="ab edit"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{ route('keterlambatan.destroy', $k->id_telat) }}" style="display:inline" onsubmit="return confirm('Hapus data ini?')">@csrf @method('DELETE')<button type="submit" class="ab del"><i class="fas fa-trash"></i></button></form>
            </div></td>
        </tr>
        @empty
        <tr><td colspan="7"><div class="empty-state"><i class="fas fa-clock"></i><h5>Tidak ada keterlambatan</h5><p>Semua siswa hadir tepat waktu</p></div></td></tr>
        @endforelse
        </tbody>
    </table>
    </div>
    <div class="tbl-foot">
        <span class="info">Menampilkan {{ $keterlambatan->firstItem() }}–{{ $keterlambatan->lastItem() }} dari {{ $keterlambatan->total() }} data</span>
        {{ $keterlambatan->links() }}
    </div>
</div>
</div>
<script>
document.getElementById('srch').addEventListener('input',function(){
    const s=this.value.toLowerCase();
    document.querySelectorAll('#tbl tbody tr').forEach(r=>{r.style.display=r.textContent.toLowerCase().includes(s)?'':'none'});
});
</script>
@endsection
