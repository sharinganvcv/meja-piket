@extends('layouts.app')
@section('content')
@include('components.page-styles')
<div class="pg-wrap">
@if(session('success'))<div class="pro-alert success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>@endif

<div class="pg-header">
    <div class="pg-title">
        <div class="icon" style="background:linear-gradient(135deg,#43e97b,#38f9d7)"><i class="fas fa-calendar-check"></i></div>
        <div><h1>Jadwal Piket</h1><p>Manajemen jadwal guru piket harian</p></div>
    </div>
    <div class="pg-actions">
        <a href="{{ route('jadwal-piket.hari-ini') }}" class="btn-sec"><i class="fas fa-calendar-day"></i> Hari Ini</a>
        @if(auth()->user()->role==='admin')
        <a href="{{ route('jadwal-piket.create') }}" class="btn-prim"><i class="fas fa-plus"></i> Tambah Jadwal</a>
        @endif
    </div>
</div>

<div class="mini-stats">
    <div class="ms-card"><div class="ms-icon s"><i class="fas fa-calendar-alt"></i></div><div><div class="ms-val">{{ $jadwalPiket->total() }}</div><div class="ms-lbl">Total Jadwal</div></div></div>
    @foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $hari)
    <div class="ms-card"><div class="ms-icon {{ $loop->index%2==0?'p':'i' }}"><i class="fas fa-calendar"></i></div><div><div class="ms-val">{{ $jadwalPiket->where('hari',$hari)->count() }}</div><div class="ms-lbl">{{ $hari }}</div></div></div>
    @endforeach
</div>

<div class="filter-box">
    <div class="filter-search"><i class="fas fa-search"></i><input type="text" id="srch" placeholder="Cari nama guru..."></div>
    <div class="filter-sel"><select id="hari"><option value="">Semua Hari</option>@foreach(['Senin','Selasa','Rabu','Kamis','Jumat'] as $h)<option value="{{ $h }}">{{ $h }}</option>@endforeach</select></div>
    <div class="filter-info">{{ $jadwalPiket->total() }} jadwal</div>
</div>

<div class="tbl-card">
    <div class="tbl-head"><h5><i class="fas fa-table"></i> Daftar Jadwal Piket</h5></div>
    <div style="overflow-x:auto">
    <table class="pro-table" id="tbl">
        <thead><tr><th>#</th><th>Guru</th><th>Hari</th><th>Jam Mulai</th><th>Jam Selesai</th><th>Semester</th><th>Status</th><th style="text-align:center">Aksi</th></tr></thead>
        <tbody>
        @forelse($jadwalPiket as $i => $j)
        <tr>
            <td>{{ $jadwalPiket->firstItem() + $i }}</td>
            <td><div style="display:flex;align-items:center;gap:.6rem"><div class="av" style="background:linear-gradient(135deg,#43e97b,#38f9d7)">{{ strtoupper(substr($j->guru->nama??'?',0,1)) }}</div><span style="font-weight:600;color:#2d3748">{{ $j->guru->nama??'-' }}</span></div></td>
            <td><span class="tag s">{{ $j->hari }}</span></td>
            <td><span style="font-size:.85rem;font-weight:600;color:#4a5568">{{ $j->jam_mulai }}</span></td>
            <td><span style="font-size:.85rem;color:#718096">{{ $j->jam_selesai }}</span></td>
            <td><span class="tag neu">{{ $j->semester }}</span></td>
            <td>@if($j->is_active)<span class="tag s">Aktif</span>@else<span class="tag d">Nonaktif</span>@endif</td>
            <td><div class="act-btns" style="justify-content:center">
                <a href="{{ route('jadwal-piket.show', $j->id) }}" class="ab view"><i class="fas fa-eye"></i></a>
                @if(auth()->user()->role==='admin')
                <a href="{{ route('jadwal-piket.edit', $j->id) }}" class="ab edit"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{ route('jadwal-piket.destroy', $j->id) }}" style="display:inline" onsubmit="return confirm('Hapus jadwal ini?')">@csrf @method('DELETE')<button type="submit" class="ab del"><i class="fas fa-trash"></i></button></form>
                @endif
            </div></td>
        </tr>
        @empty
        <tr><td colspan="8"><div class="empty-state"><i class="fas fa-calendar-times"></i><h5>Belum ada jadwal piket</h5></div></td></tr>
        @endforelse
        </tbody>
    </table>
    </div>
    <div class="tbl-foot">
        <span class="info">Menampilkan {{ $jadwalPiket->firstItem() }}–{{ $jadwalPiket->lastItem() }} dari {{ $jadwalPiket->total() }} data</span>
        {{ $jadwalPiket->links() }}
    </div>
</div>
</div>
<script>
function filter(){
    const s=document.getElementById('srch').value.toLowerCase();
    const h=document.getElementById('hari').value;
    document.querySelectorAll('#tbl tbody tr').forEach(r=>{
        const txt=r.textContent.toLowerCase();
        r.style.display=(txt.includes(s)&&(h===''||txt.includes(h.toLowerCase())))?'':'none';
    });
}
document.getElementById('srch').addEventListener('input',filter);
document.getElementById('hari').addEventListener('change',filter);
</script>
@endsection
