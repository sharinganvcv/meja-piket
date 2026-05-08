@extends('layouts.app')
@section('content')
@include('components.page-styles')
<div class="pg-wrap">
@if(session('success'))<div class="pro-alert success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>@endif

<div class="pg-header">
    <div class="pg-title">
        <div class="icon" style="background:linear-gradient(135deg,#667eea,#764ba2)"><i class="fas fa-clipboard-list"></i></div>
        <div><h1>Data Piket</h1><p>Rekap kehadiran guru piket harian</p></div>
    </div>
    <div class="pg-actions">
        @if(auth()->user()->role==='admin')
        <a href="{{ route('piket.create') }}" class="btn-prim"><i class="fas fa-plus"></i> Tambah Piket</a>
        @endif
    </div>
</div>

<div class="mini-stats">
    <div class="ms-card"><div class="ms-icon p"><i class="fas fa-clipboard-check"></i></div><div><div class="ms-val">{{ $piket->total() }}</div><div class="ms-lbl">Total Piket</div></div></div>
    <div class="ms-card"><div class="ms-icon s"><i class="fas fa-calendar-day"></i></div><div><div class="ms-val">{{ $piket->where('tanggal',today()->format('Y-m-d'))->count() }}</div><div class="ms-lbl">Hari Ini</div></div></div>
</div>

<div class="filter-box">
    <div class="filter-search"><i class="fas fa-search"></i><input type="text" id="srch" placeholder="Cari nama guru..."></div>
    <div class="filter-info">{{ $piket->total() }} data</div>
</div>

<div class="tbl-card">
    <div class="tbl-head"><h5><i class="fas fa-table"></i> Daftar Piket</h5></div>
    <div style="overflow-x:auto">
    <table class="pro-table" id="tbl">
        <thead><tr><th>#</th><th>Guru</th><th>Tanggal</th><th style="text-align:center">Aksi</th></tr></thead>
        <tbody>
        @forelse($piket as $i => $p)
        <tr>
            <td>{{ $piket->firstItem() + $i }}</td>
            <td><div style="display:flex;align-items:center;gap:.6rem"><div class="av">{{ strtoupper(substr($p->guru->nama??'?',0,1)) }}</div><span style="font-weight:600;color:#2d3748">{{ $p->guru->nama??'-' }}</span></div></td>
            <td><span style="font-size:.85rem;color:#4a5568">{{ \Carbon\Carbon::parse($p->tanggal)->format('d M Y') }}</span></td>
            <td><div class="act-btns" style="justify-content:center">
                <a href="{{ route('piket.show', $p->id_piket) }}" class="ab view"><i class="fas fa-eye"></i></a>
                @if(auth()->user()->role==='admin')
                <a href="{{ route('piket.edit', $p->id_piket) }}" class="ab edit"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{ route('piket.destroy', $p->id_piket) }}" style="display:inline" onsubmit="return confirm('Hapus data ini?')">@csrf @method('DELETE')<button type="submit" class="ab del"><i class="fas fa-trash"></i></button></form>
                @endif
            </div></td>
        </tr>
        @empty
        <tr><td colspan="4"><div class="empty-state"><i class="fas fa-clipboard"></i><h5>Belum ada data piket</h5></div></td></tr>
        @endforelse
        </tbody>
    </table>
    </div>
    <div class="tbl-foot">
        <span class="info">Menampilkan {{ $piket->firstItem() }}–{{ $piket->lastItem() }} dari {{ $piket->total() }} data</span>
        {{ $piket->links() }}
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
