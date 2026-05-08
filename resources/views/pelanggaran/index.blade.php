@extends('layouts.app')
@section('content')
@include('components.page-styles')
<div class="pg-wrap">
@if(session('success'))<div class="pro-alert success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>@endif
@if(session('error'))<div class="pro-alert danger"><i class="fas fa-exclamation-circle"></i>{{ session('error') }}</div>@endif

<div class="pg-header">
    <div class="pg-title">
        <div class="icon" style="background:linear-gradient(135deg,#fa709a,#fee140)"><i class="fas fa-exclamation-triangle"></i></div>
        <div><h1>Data Pelanggaran</h1><p>Pencatatan dan rekap pelanggaran siswa</p></div>
    </div>
    <div class="pg-actions">
        <a href="{{ route('pelanggaran.create') }}" class="btn-prim"><i class="fas fa-plus"></i> Catat Pelanggaran</a>
    </div>
</div>

<div class="mini-stats">
    <div class="ms-card"><div class="ms-icon w"><i class="fas fa-exclamation-triangle"></i></div><div><div class="ms-val">{{ $pelanggaran->total() }}</div><div class="ms-lbl">Total Kasus</div></div></div>
    <div class="ms-card"><div class="ms-icon d"><i class="fas fa-star"></i></div><div><div class="ms-val">{{ $pelanggaran->sum('poin') }}</div><div class="ms-lbl">Total Poin</div></div></div>
    <div class="ms-card"><div class="ms-icon p"><i class="fas fa-calendar-day"></i></div><div><div class="ms-val">{{ $pelanggaran->where('tanggal',today()->format('Y-m-d'))->count() }}</div><div class="ms-lbl">Hari Ini</div></div></div>
</div>

<div class="filter-box">
    <div class="filter-search"><i class="fas fa-search"></i><input type="text" id="srch" placeholder="Cari nama siswa atau jenis pelanggaran..."></div>
    <div class="filter-info">{{ $pelanggaran->total() }} kasus</div>
</div>

<div class="tbl-card">
    <div class="tbl-head"><h5><i class="fas fa-table"></i> Daftar Pelanggaran</h5></div>
    <div style="overflow-x:auto">
    <table class="pro-table" id="tbl">
        <thead><tr><th>#</th><th>Siswa</th><th>Kelas</th><th>Jenis Pelanggaran</th><th>Tanggal</th><th>Poin</th><th>Dicatat Oleh</th><th style="text-align:center">Aksi</th></tr></thead>
        <tbody>
        @forelse($pelanggaran as $i => $p)
        <tr>
            <td>{{ $pelanggaran->firstItem() + $i }}</td>
            <td><div style="display:flex;align-items:center;gap:.6rem"><div class="av" style="background:linear-gradient(135deg,#fa709a,#fee140)">{{ strtoupper(substr($p->siswa->nama??'?',0,1)) }}</div><span style="font-weight:600;color:#2d3748">{{ $p->siswa->nama??'-' }}</span></div></td>
            <td><span class="tag p">{{ $p->siswa->kelas??'-' }}</span></td>
            <td><span style="font-size:.85rem;color:#4a5568">{{ Str::limit($p->jenis_pelanggaran,35) }}</span></td>
            <td><span style="font-size:.83rem;color:#718096">{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</span></td>
            <td><span class="tag {{ $p->poin>=50?'d':($p->poin>=20?'w':'s') }}">{{ $p->poin }} poin</span></td>
            <td><span style="font-size:.82rem;color:#718096">{{ $p->guru->nama??'-' }}</span></td>
            <td><div class="act-btns" style="justify-content:center">
                <a href="{{ route('pelanggaran.show', $p->id) }}" class="ab view"><i class="fas fa-eye"></i></a>
                <a href="{{ route('pelanggaran.edit', $p->id) }}" class="ab edit"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{ route('pelanggaran.destroy', $p->id) }}" style="display:inline" onsubmit="return confirm('Hapus data ini?')">@csrf @method('DELETE')<button type="submit" class="ab del"><i class="fas fa-trash"></i></button></form>
            </div></td>
        </tr>
        @empty
        <tr><td colspan="8"><div class="empty-state"><i class="fas fa-check-shield"></i><h5>Tidak ada data pelanggaran</h5><p>Semua siswa berperilaku baik</p></div></td></tr>
        @endforelse
        </tbody>
    </table>
    </div>
    <div class="tbl-foot">
        <span class="info">Menampilkan {{ $pelanggaran->firstItem() }}–{{ $pelanggaran->lastItem() }} dari {{ $pelanggaran->total() }} data</span>
        {{ $pelanggaran->links() }}
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
