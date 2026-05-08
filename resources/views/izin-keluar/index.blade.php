@extends('layouts.app')
@section('content')
@include('components.page-styles')
<div class="pg-wrap">
@if(session('success'))<div class="pro-alert success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>@endif
@if(session('error'))<div class="pro-alert danger"><i class="fas fa-exclamation-circle"></i>{{ session('error') }}</div>@endif

<div class="pg-header">
    <div class="pg-title">
        <div class="icon" style="background:linear-gradient(135deg,#4facfe,#00f2fe)"><i class="fas fa-door-open"></i></div>
        <div><h1>Izin Keluar Siswa</h1><p>Pencatatan izin keluar dan kepulangan siswa</p></div>
    </div>
    <div class="pg-actions">
        <a href="{{ route('izin-keluar.create') }}" class="btn-prim"><i class="fas fa-plus"></i> Tambah Izin</a>
    </div>
</div>

<div class="mini-stats">
    <div class="ms-card"><div class="ms-icon i"><i class="fas fa-door-open"></i></div><div><div class="ms-val">{{ $izinKeluar->total() }}</div><div class="ms-lbl">Total Izin</div></div></div>
    <div class="ms-card"><div class="ms-icon s"><i class="fas fa-check-circle"></i></div><div><div class="ms-val">{{ $izinKeluar->where('status','kembali')->count() }}</div><div class="ms-lbl">Sudah Kembali</div></div></div>
    <div class="ms-card"><div class="ms-icon w"><i class="fas fa-spinner"></i></div><div><div class="ms-val">{{ $izinKeluar->where('status','keluar')->count() }}</div><div class="ms-lbl">Belum Kembali</div></div></div>
</div>

<div class="filter-box">
    <div class="filter-search"><i class="fas fa-search"></i><input type="text" id="srch" placeholder="Cari nama siswa atau alasan..."></div>
    <div class="filter-sel"><select id="stat"><option value="">Semua Status</option><option value="keluar">Keluar</option><option value="kembali">Kembali</option></select></div>
    <div class="filter-info">{{ $izinKeluar->total() }} izin</div>
</div>

<div class="tbl-card">
    <div class="tbl-head"><h5><i class="fas fa-table"></i> Daftar Izin Keluar</h5></div>
    <div style="overflow-x:auto">
    <table class="pro-table" id="tbl">
        <thead><tr><th>#</th><th>Siswa</th><th>Kelas</th><th>Alasan</th><th>Waktu Keluar</th><th>Waktu Kembali</th><th>Status</th><th style="text-align:center">Aksi</th></tr></thead>
        <tbody>
        @forelse($izinKeluar as $i => $iz)
        <tr>
            <td>{{ $izinKeluar->firstItem() + $i }}</td>
            <td><div style="display:flex;align-items:center;gap:.6rem"><div class="av" style="background:linear-gradient(135deg,#4facfe,#00f2fe)">{{ strtoupper(substr($iz->siswa->nama??'?',0,1)) }}</div><span style="font-weight:600;color:#2d3748">{{ $iz->siswa->nama??'-' }}</span></div></td>
            <td><span class="tag p">{{ $iz->siswa->kelas??'-' }}</span></td>
            <td><span style="font-size:.83rem;color:#718096">{{ Str::limit($iz->alasan,35) }}</span></td>
            <td><span style="font-size:.83rem;color:#4a5568">{{ \Carbon\Carbon::parse($iz->waktu_keluar)->format('d M H:i') }}</span></td>
            <td><span style="font-size:.83rem;color:#4a5568">{{ $iz->waktu_kembali ? \Carbon\Carbon::parse($iz->waktu_kembali)->format('d M H:i') : '-' }}</span></td>
            <td>
                @if($iz->status==='kembali')<span class="tag s">Kembali</span>
                @elseif($iz->status==='keluar')<span class="tag w">Keluar</span>
                @else<span class="tag neu">{{ $iz->status }}</span>@endif
            </td>
            <td><div class="act-btns" style="justify-content:center">
                <a href="{{ route('izin-keluar.show', $iz->id_izin) }}" class="ab view"><i class="fas fa-eye"></i></a>
                <a href="{{ route('izin-keluar.edit', $iz->id_izin) }}" class="ab edit"><i class="fas fa-edit"></i></a>
                <form method="POST" action="{{ route('izin-keluar.destroy', $iz->id_izin) }}" style="display:inline" onsubmit="return confirm('Hapus data ini?')">@csrf @method('DELETE')<button type="submit" class="ab del"><i class="fas fa-trash"></i></button></form>
            </div></td>
        </tr>
        @empty
        <tr><td colspan="8"><div class="empty-state"><i class="fas fa-door-open"></i><h5>Tidak ada data izin keluar</h5></div></td></tr>
        @endforelse
        </tbody>
    </table>
    </div>
    <div class="tbl-foot">
        <span class="info">Menampilkan {{ $izinKeluar->firstItem() }}–{{ $izinKeluar->lastItem() }} dari {{ $izinKeluar->total() }} data</span>
        {{ $izinKeluar->links() }}
    </div>
</div>
</div>
<script>
function filter(){
    const s=document.getElementById('srch').value.toLowerCase();
    const st=document.getElementById('stat').value.toLowerCase();
    document.querySelectorAll('#tbl tbody tr').forEach(r=>{
        const txt=r.textContent.toLowerCase();
        r.style.display=(txt.includes(s)&&(st===''||txt.includes(st)))?'':'none';
    });
}
document.getElementById('srch').addEventListener('input',filter);
document.getElementById('stat').addEventListener('change',filter);
</script>
@endsection
