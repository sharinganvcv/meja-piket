@extends('layouts.app')
@section('content')
@include('components.page-styles')
<div class="pg-wrap">
@if(session('success'))<div class="pro-alert success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>@endif
@if(session('error'))<div class="pro-alert danger"><i class="fas fa-exclamation-circle"></i>{{ session('error') }}</div>@endif

<div class="pg-header">
    <div class="pg-title">
        <div class="icon" style="background:linear-gradient(135deg,#43e97b,#38f9d7)"><i class="fas fa-chalkboard-teacher"></i></div>
        <div><h1>Data Guru</h1><p>Kelola seluruh data guru & tenaga pengajar</p></div>
    </div>
    <div class="pg-actions">
        @if(auth()->user()->role==='admin')
        <a href="{{ route('guru.create') }}" class="btn-prim"><i class="fas fa-plus"></i> Tambah Guru</a>
        @endif
    </div>
</div>

<div class="mini-stats">
    <div class="ms-card"><div class="ms-icon p"><i class="fas fa-chalkboard-teacher"></i></div><div><div class="ms-val">{{ $guru->total() }}</div><div class="ms-lbl">Total Guru</div></div></div>
    <div class="ms-card"><div class="ms-icon s"><i class="fas fa-user-check"></i></div><div><div class="ms-val">{{ $guru->total() }}</div><div class="ms-lbl">Aktif</div></div></div>
</div>

<div class="filter-box">
    <div class="filter-search"><i class="fas fa-search"></i><input type="text" id="srch" placeholder="Cari nama atau jabatan..."></div>
    <div class="filter-info">{{ $guru->total() }} guru ditemukan</div>
</div>

<div class="tbl-card">
    <div class="tbl-head"><h5><i class="fas fa-table"></i> Daftar Guru</h5></div>
    <div style="overflow-x:auto">
    <table class="pro-table" id="tbl">
        <thead><tr><th>#</th><th>Nama Guru</th><th>Jabatan</th><th>Jam Jaga</th><th style="text-align:center">Aksi</th></tr></thead>
        <tbody>
        @forelse($guru as $i => $g)
        <tr>
            <td>{{ $guru->firstItem() + $i }}</td>
            <td><div style="display:flex;align-items:center;gap:.6rem"><div class="av" style="background:linear-gradient(135deg,#43e97b,#38f9d7)">{{ strtoupper(substr($g->nama,0,1)) }}</div><span style="font-weight:600;color:#2d3748">{{ $g->nama }}</span></div></td>
            <td><span class="tag s">{{ $g->jabatan ?? '-' }}</span></td>
            <td>
                @if($g->jam_masuk && $g->jam_pulang)
                    <span class="badge bg-light text-dark border">
                        <i class="far fa-clock me-1"></i>
                        {{ \Carbon\Carbon::parse($g->jam_masuk)->format('H:i') }} - {{ \Carbon\Carbon::parse($g->jam_pulang)->format('H:i') }}
                    </span>
                @else
                    <span class="text-muted small">-</span>
                @endif
            </td>
            <td><div class="act-btns" style="justify-content:center">
                <a href="{{ route('guru.show', $g->id_guru) }}" class="ab view"><i class="fas fa-eye"></i></a>
                @if(auth()->user()->role==='admin')
                <a href="{{ route('guru.edit', $g->id_guru) }}" class="ab edit"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{ route('guru.destroy', $g->id_guru) }}" style="display:inline" onsubmit="return confirm('Hapus guru ini?')">@csrf @method('DELETE')<button type="submit" class="ab del"><i class="fas fa-trash"></i></button></form>
                @endif
            </div></td>
        </tr>
        @empty
        <tr><td colspan="4"><div class="empty-state"><i class="fas fa-chalkboard-teacher"></i><h5>Belum ada data guru</h5></div></td></tr>
        @endforelse
        </tbody>
    </table>
    </div>
    <div class="tbl-foot">
        <span class="info">Menampilkan {{ $guru->firstItem() }}–{{ $guru->lastItem() }} dari {{ $guru->total() }} data</span>
        {{ $guru->links() }}
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
