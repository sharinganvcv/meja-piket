@extends('layouts.app')
@section('content')
@include('components.page-styles')
<div class="pg-wrap py-4">
    <div class="pg-header">
        <div class="pg-title">
            <div class="icon" style="background:linear-gradient(135deg,#4facfe,#00f2fe)"><i class="fas fa-door-open"></i></div>
            <div><h1>Ajukan Izin Keluar</h1><p>Pilih satu atau banyak siswa sekaligus</p></div>
        </div>
        <div class="pg-actions">
            <a href="{{ route('izin-keluar.index') }}" class="btn-sec"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
    
    <form action="{{ route('izin-keluar.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="tbl-card">
                    <div class="tbl-head d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-users"></i> Pilih Siswa</h5>
                        <div class="d-flex gap-2">
                            <input type="text" id="siswaSearch" placeholder="Cari nama/NIS..." class="pro-input" style="width:180px; padding:.4rem .8rem">
                            <select id="kelasFilter" class="pro-select" style="width:120px; padding:.4rem">
                                <option value="">Tingkat</option>
                                <option value="X">Kelas X</option>
                                <option value="XI">Kelas XI</option>
                                <option value="XII">Kelas XII</option>
                            </select>
                            <select id="jurusanFilter" class="pro-select" style="width:120px; padding:.4rem">
                                <option value="">Jurusan</option>
                                <option value="PPLG">PPLG</option>
                                <option value="BCF">BCF</option>
                                <option value="TO">TO</option>
                                <option value="TPFL">TPFL</option>
                            </select>
                        </div>
                    </div>
                    <div style="max-height: 500px; overflow-y: auto;">
                        <table class="pro-table" id="siswaTable">
                            <thead>
                                <tr>
                                    <th style="width: 40px;"><input type="checkbox" id="selectAll" style="width:18px; height:18px"></th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswa as $s)
                                <tr class="siswa-row" data-kelas="{{ $s->kelas }}">
                                    <td><input type="checkbox" name="id_siswa[]" value="{{ $s->id_siswa }}" class="siswa-checkbox" style="width:18px; height:18px"></td>
                                    <td><span class="tag neu">{{ $s->nis }}</span></td>
                                    <td><strong>{{ $s->nama }}</strong></td>
                                    <td><span class="tag p">{{ $s->kelas }}</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tbl-foot">
                        <span id="selectedCount" class="info">0 siswa dipilih</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="form-card">
                    <h6 class="form-section-title">Detail Izin</h6>
                    
                    <div class="mb-3">
                        <label for="id_guru" class="pro-label">Guru Pemberi Izin</label>
                        <select class="pro-select @error('id_guru') is-invalid @enderror" id="id_guru" name="id_guru" required>
                            <option value="">-- Pilih Guru --</option>
                            @foreach($guru as $g)
                                <option value="{{ $g->id_guru }}" {{ old('id_guru') == $g->id_guru ? 'selected' : '' }}>
                                    {{ $g->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_guru')<div class="err-msg">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="alasan" class="pro-label">Alasan Izin</label>
                        <textarea class="pro-textarea @error('alasan') is-invalid @enderror" id="alasan" name="alasan" rows="3" placeholder="Contoh: Lomba sekolah, Sakit, Urusan keluarga..." required>{{ old('alasan') }}</textarea>
                        @error('alasan')<div class="err-msg">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="waktu_keluar" class="pro-label">Waktu Keluar</label>
                        <input type="datetime-local" class="pro-input @error('waktu_keluar') is-invalid @enderror" id="waktu_keluar" name="waktu_keluar" value="{{ old('waktu_keluar', now()->format('Y-m-d\TH:i')) }}" required>
                        @error('waktu_keluar')<div class="err-msg">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="alert alert-info py-2" style="font-size: 0.8rem; border-radius:10px">
                        <i class="fas fa-info-circle me-1"></i> Izin yang diajukan akan otomatis berstatus <strong>Keluar</strong>.
                    </div>
                    
                    <button type="submit" class="btn-prim w-100 justify-content-center py-2" style="font-size: 1rem">
                        <i class="fas fa-paper-plane"></i> Ajukan Izin Massal
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('siswaSearch');
    const kelasFilter = document.getElementById('kelasFilter');
    const jurusanFilter = document.getElementById('jurusanFilter');
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.siswa-checkbox');
    const selectedCount = document.getElementById('selectedCount');
    const rows = document.querySelectorAll('.siswa-row');

    function updateCount() {
        const checkedCount = document.querySelectorAll('.siswa-checkbox:checked').length;
        selectedCount.textContent = checkedCount + ' siswa dipilih';
    }

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const filterKelas = kelasFilter.value;
        const filterJurusan = jurusanFilter.value;

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const kelas = row.getAttribute('data-kelas');
            const matchesSearch = text.includes(searchTerm);
            const matchesKelas = filterKelas === '' || kelas.startsWith(filterKelas);
            const matchesJurusan = filterJurusan === '' || kelas.includes(filterJurusan);
            
            row.style.display = (matchesSearch && matchesKelas && matchesJurusan) ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTable);
    kelasFilter.addEventListener('change', filterTable);
    jurusanFilter.addEventListener('change', filterTable);

    selectAll.addEventListener('change', function() {
        checkboxes.forEach(cb => {
            if (cb.closest('tr').style.display !== 'none') {
                cb.checked = selectAll.checked;
            }
        });
        updateCount();
    });

    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateCount);
    });
});
</script>
@endsection
