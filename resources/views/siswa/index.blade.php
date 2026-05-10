@extends('layouts.app')
@section('content')
@include('components.page-styles')
<div class="pg-wrap">
@if(session('success'))<div class="pro-alert success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>@endif
@if(session('error'))<div class="pro-alert danger"><i class="fas fa-exclamation-circle"></i>{{ session('error') }}</div>@endif

<div class="pg-header">
    <div class="pg-title">
        <div class="icon"><i class="fas fa-users"></i></div>
        <div><h1>Data Siswa</h1><p>Kelola seluruh data siswa sekolah</p></div>
    </div>
    <div class="pg-actions">
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('siswa.create') }}" class="btn-prim"><i class="fas fa-plus"></i> Tambah Siswa</a>
        @endif
    </div>
</div>

<div class="mini-stats">
    <div class="ms-card"><div class="ms-icon p"><i class="fas fa-users"></i></div><div><div class="ms-val">{{ $totalSiswa }}</div><div class="ms-lbl">Total Siswa</div></div></div>
    <div class="ms-card"><div class="ms-icon s"><i class="fas fa-graduation-cap"></i></div><div><div class="ms-val">{{ $countX }}</div><div class="ms-lbl">Kelas X</div></div></div>
    <div class="ms-card"><div class="ms-icon w"><i class="fas fa-graduation-cap"></i></div><div><div class="ms-val">{{ $countXI }}</div><div class="ms-lbl">Kelas XI</div></div></div>
    <div class="ms-card"><div class="ms-icon i"><i class="fas fa-graduation-cap"></i></div><div><div class="ms-val">{{ $countXII }}</div><div class="ms-lbl">Kelas XII</div></div></div>
</div>

<form method="GET" action="{{ route('siswa.index') }}" class="filter-box" id="filterForm">
    <div class="filter-search">
        <i class="fas fa-search"></i>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NIS...">
    </div>
    <div class="filter-sel">
        <select name="kelas" onchange="document.getElementById('filterForm').submit()">
            <option value="">Semua Kelas</option>
            <option value="X" {{ request('kelas') == 'X' ? 'selected' : '' }}>Kelas X</option>
            <option value="XI" {{ request('kelas') == 'XI' ? 'selected' : '' }}>Kelas XI</option>
            <option value="XII" {{ request('kelas') == 'XII' ? 'selected' : '' }}>Kelas XII</option>
        </select>
    </div>
    <div class="filter-info">{{ $siswa->total() }} siswa ditemukan</div>
</form>

<div class="tbl-card">
    <div class="tbl-head"><h5><i class="fas fa-table"></i> Daftar Siswa</h5></div>
    <div style="overflow-x:auto">
    <table class="pro-table" id="tbl">
        <thead><tr><th>#</th><th>NIS</th><th>Nama Siswa</th><th>Kelas</th><th style="text-align:center">Aksi</th></tr></thead>
        <tbody>
        @forelse($siswa as $i => $s)
        <tr>
            <td>{{ $siswa->firstItem() + $i }}</td>
            <td><span class="tag neu">{{ $s->nis }}</span></td>
            <td><div style="display:flex;align-items:center;gap:.6rem"><div class="av">{{ strtoupper(substr($s->nama,0,1)) }}</div><span style="font-weight:600;color:#2d3748">{{ $s->nama }}</span></div></td>
            <td><span class="tag p">{{ $s->kelas }}</span></td>

            <td><div class="act-btns" style="justify-content:center">
                <a href="{{ route('siswa.show', $s->id_siswa) }}" class="ab view" title="Detail"><i class="fas fa-eye"></i></a>
                @if(auth()->user()->role==='admin')
                <a href="{{ route('siswa.edit', $s->id_siswa) }}" class="ab edit" title="Edit"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{ route('siswa.destroy', $s->id_siswa) }}" style="display:inline" onsubmit="return confirm('Hapus siswa ini?')">@csrf @method('DELETE')<button type="submit" class="ab del" title="Hapus"><i class="fas fa-trash"></i></button></form>
                @endif
            </div></td>
        </tr>
        @empty
        <tr><td colspan="5"><div class="empty-state"><i class="fas fa-users"></i><h5>Belum ada data siswa</h5><p>Tambahkan siswa baru untuk memulai</p></div></td></tr>
        @endforelse
        </tbody>
    </table>
    </div>
    <div class="tbl-foot">
        <span class="info">Menampilkan {{ $siswa->firstItem() }}–{{ $siswa->lastItem() }} dari {{ $siswa->total() }} data</span>
        {{ $siswa->links() }}
    </div>
</div>
</div>
<script>
    // Submit form automatically when user stops typing in the search box
    let timeout = null;
    const searchInput = document.querySelector('input[name="search"]');
    if(searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                document.getElementById('filterForm').submit();
            }, 500);
        });
        
        // Move cursor to the end of the input field
        const len = searchInput.value.length;
        searchInput.setSelectionRange(len, len);
        searchInput.focus();
    }
</script>
@endsection
