@extends('layouts.app')
@section('content')
@include('components.page-styles')
<div class="pg-wrap">
@if(session('success'))<div class="pro-alert success"><i class="fas fa-check-circle"></i>{{ session('success') }}</div>@endif
@if(session('warning'))<div class="pro-alert warning"><i class="fas fa-exclamation-triangle"></i>{{ session('warning') }}</div>@endif
@if(session('info'))<div class="pro-alert info"><i class="fas fa-info-circle"></i>{{ session('info') }}</div>@endif
@if(session('error'))<div class="pro-alert danger"><i class="fas fa-exclamation-circle"></i>{{ session('error') }}</div>@endif

<div class="pg-header">
    <div class="pg-title">
        <div class="icon"><i class="fas fa-users"></i></div>
        <div><h1>Data Siswa</h1><p>Kelola seluruh data siswa sekolah</p></div>
    </div>
    <div class="pg-actions">
        @if(auth()->user()->role === 'admin')
        <button type="button" class="btn-prim secondary" data-bs-toggle="modal" data-bs-target="#importModal">
            <i class="fas fa-file-csv"></i> Import CSV
        </button>
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

<form method="GET" action="{{ route('siswa.index') }}" class="filter-card mb-4" id="filterForm">
    <div class="row g-3">
        <div class="col-lg-4">
            <div class="filter-search">
                <i class="fas fa-search"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau NIS..." class="form-control">
            </div>
        </div>
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center h-100">
                <button type="button" class="btn-sec" onclick="toggleAdvancedFilter()">
                    <i class="fas fa-filter"></i> Filter Lanjutan
                </button>
                <div class="filter-info">{{ $siswa->count() }} siswa ditemukan</div>
            </div>
        </div>
    </div>

    <div id="advancedFilter" class="mt-3 p-3 border-top" style="{{ request('tingkat') || request('jurusan') || request('kelas_detail') ? '' : 'display:none' }}">
        <div class="row">
            <div class="col-md-4">
                <h6 class="filter-label">Tingkat</h6>
                <div class="checkbox-group">
                    @foreach(['X', 'XI', 'XII'] as $t)
                    <label class="check-item">
                        <input type="checkbox" name="tingkat[]" value="{{ $t }}" {{ is_array(request('tingkat')) && in_array($t, request('tingkat')) ? 'checked' : '' }} onchange="this.form.submit()">
                        <span>Kelas {{ $t }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <h6 class="filter-label">Jurusan</h6>
                <div class="checkbox-group">
                    @foreach(['PPLG', 'BCF', 'TO', 'TPFL'] as $j)
                    <label class="check-item">
                        <input type="checkbox" name="jurusan[]" value="{{ $j }}" {{ is_array(request('jurusan')) && in_array($j, request('jurusan')) ? 'checked' : '' }} onchange="this.form.submit()">
                        <span>{{ $j }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="col-md-4">
                <h6 class="filter-label">Kelas Spesifik</h6>
                <div class="checkbox-group scrollable">
                    @php
                        $details = [
                            'PPLG 1', 'PPLG 2', 'PPLG 3', 
                            'BCF 1', 'BCF 2', 
                            'TO 1', 'TO 2', 
                            'TPFL 1', 'TPFL 2'
                        ];
                    @endphp
                    @foreach($details as $kd)
                    <label class="check-item">
                        <input type="checkbox" name="kelas_detail[]" value="{{ $kd }}" {{ is_array(request('kelas_detail')) && in_array($kd, request('kelas_detail')) ? 'checked' : '' }} onchange="this.form.submit()">
                        <span>{{ $kd }}</span>
                    </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mt-3 text-end">
            <a href="{{ route('siswa.index') }}" class="btn-sec btn-sm">Reset Filter</a>
        </div>
    </div>
</form>

<script>
    function toggleAdvancedFilter() {
        const div = document.getElementById('advancedFilter');
        div.style.display = div.style.display === 'none' ? 'block' : 'none';
    }
</script>

<div class="tbl-card">
    <div class="tbl-head d-flex justify-content-between align-items-center">
        <h5><i class="fas fa-table"></i> Daftar Siswa</h5>
        @if(auth()->user()->role === 'admin')
        <button type="button" id="btnBulkDelete" class="btn-del" style="display:none; padding:.4rem .9rem; font-size:.78rem; background:#fee2e2; color:#dc2626; border:1.5px solid #fca5a5; border-radius:10px; cursor:pointer; font-weight:600" onclick="executeBulkDelete()">
            <i class="fas fa-trash-alt"></i> Hapus Terpilih (<span id="countSelected">0</span>)
        </button>
        @endif
    </div>
    <div style="overflow-x:auto">
    <table class="pro-table" id="tbl">
        <thead>
            <tr>
                @if(auth()->user()->role === 'admin')
                <th style="width:40px"><input type="checkbox" id="selectAllSiswa" style="width:16px;height:16px;accent-color:#667eea"></th>
                @endif
                <th>#</th>
                <th>NIS</th>
                <th>Nama Siswa</th>
                <th>Kelas</th>
                <th>Jenis Kelamin</th>
                <th style="text-align:center">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($siswa as $i => $s)
        <tr>
            @if(auth()->user()->role === 'admin')
            <td><input type="checkbox" value="{{ $s->id_siswa }}" class="siswa-cb" style="width:16px;height:16px;accent-color:#667eea"></td>
            @endif
            <td>{{ $i + 1 }}</td>
            <td><span class="tag neu">{{ $s->nis }}</span></td>
            <td><div style="display:flex;align-items:center;gap:.6rem"><div class="av">{{ strtoupper(substr($s->nama,0,1)) }}</div><span style="font-weight:600;color:#2d3748">{{ $s->nama }}</span></div></td>
            <td><span class="tag p">{{ $s->kelas }}</span></td>
            <td>
                @if($s->jenis_kelamin === 'L')
                    <span class="tag" style="background:#dbeafe;color:#1d4ed8">♂ Laki-laki</span>
                @elseif($s->jenis_kelamin === 'P')
                    <span class="tag" style="background:#fce7f3;color:#be185d">♀ Perempuan</span>
                @else
                    <span style="color:#a0aec0;font-size:.8rem">-</span>
                @endif
            </td>
            <td><div class="act-btns" style="justify-content:center">
                <a href="{{ route('siswa.show', $s->id_siswa) }}" class="ab view" title="Detail"><i class="fas fa-eye"></i></a>
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('siswa.edit', $s->id_siswa) }}" class="ab edit" title="Edit"><i class="fas fa-edit"></i></a>
                <button type="button" class="ab del" onclick="deleteSiswa('{{ $s->id_siswa }}')" title="Hapus"><i class="fas fa-trash"></i></button>
                @endif
            </div></td>
        </tr>
        @empty
        <tr><td colspan="7"><div class="empty-state"><i class="fas fa-users"></i><h5>Belum ada data siswa</h5><p>Tambahkan siswa baru untuk memulai</p></div></td></tr>
        @endforelse
        </tbody>
    </table>
    </div>
    <div class="tbl-foot">
        <span class="info">Menampilkan {{ $siswa->count() }} data siswa</span>
    </div>
</div>

{{-- Hidden form for single delete --}}
<form id="deleteSiswaForm" method="POST" style="display:none">
    @csrf
    @method('DELETE')
</form>

</div>
<script>
    // Auto-submit search with debounce
    let timeout = null;
    const searchInput = document.querySelector('input[name="search"]');
    if(searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                document.getElementById('filterForm').submit();
            }, 500);
        });
        const len = searchInput.value.length;
        searchInput.setSelectionRange(len, len);
        searchInput.focus();
    }

    // --- CHECKBOX & BULK DELETE ---
    const selectAll = document.getElementById('selectAllSiswa');
    const checkboxes = document.querySelectorAll('.siswa-cb');
    const btnBulkDelete = document.getElementById('btnBulkDelete');
    const countSpan = document.getElementById('countSelected');

    function updateDeleteButton() {
        if (!btnBulkDelete) return;
        const checked = document.querySelectorAll('.siswa-cb:checked').length;
        if (countSpan) countSpan.textContent = checked;
        btnBulkDelete.style.display = checked > 0 ? 'inline-flex' : 'none';
    }

    if (selectAll) {
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => { cb.checked = selectAll.checked; });
            updateDeleteButton();
        });
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateDeleteButton);
    });

    // Single delete via JS
    function deleteSiswa(id) {
        if (!confirm('Hapus siswa ini? Tindakan ini tidak bisa dibatalkan.')) return;
        const form = document.getElementById('deleteSiswaForm');
        form.action = '/siswa/' + id;
        form.submit();
    }

    // Bulk delete via AJAX
    async function executeBulkDelete() {
        const cbs = document.querySelectorAll('.siswa-cb:checked');
        const ids = Array.from(cbs).map(cb => cb.value);
        if (ids.length === 0) return;

        if (!confirm('Hapus ' + ids.length + ' siswa terpilih? Tindakan ini TIDAK BISA DIBATALKAN!')) return;

        const btn = document.getElementById('btnBulkDelete');
        const orig = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menghapus...';

        try {
            const res = await fetch('{{ route("siswa.bulk-delete") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ ids: ids })
            });
            if (res.ok) {
                window.location.reload();
            } else {
                const data = await res.json();
                alert('Gagal: ' + (data.message || 'Terjadi kesalahan.'));
                btn.disabled = false;
                btn.innerHTML = orig;
            }
        } catch(e) {
            alert('Terjadi kesalahan koneksi.');
            btn.disabled = false;
            btn.innerHTML = orig;
        }
    }
</script>
<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header" style="border-bottom: 1px solid #f1f5f9; padding: 1.5rem;">
                <h5 class="modal-title" style="font-weight: 700; color: #1e293b;"><i class="fas fa-file-csv me-2" style="color: #6366f1;"></i>Import Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body" style="padding: 1.5rem;">
                    <div class="alert alert-info" style="border-radius: 12px; font-size: 0.875rem; border: none; background: #eef2ff; color: #4338ca;">
                        <i class="fas fa-info-circle me-2"></i>Format CSV: <strong>NIS, Nama, Kelas, Jenis Kelamin (L/P)</strong><br>
                        <small style="opacity:.8">Kolom Jenis Kelamin bersifat opsional. Baris pertama = header.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight: 600; color: #475569;">Pilih File CSV</label>
                        <input type="file" name="file" class="form-control" accept=".csv" required style="border-radius: 10px; padding: 10px;">
                    </div>
                    <div style="font-size: 0.75rem; color: #94a3b8;">
                        *Baris pertama akan dianggap sebagai header dan akan diabaikan.
                    </div>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #f1f5f9; padding: 1.25rem;">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius: 10px;">Batal</button>
                    <button type="submit" class="btn-prim" style="border-radius: 10px; border: none; padding: 10px 20px;">Upload & Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
