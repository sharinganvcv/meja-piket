<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.page-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="pg-wrap">
<?php if(session('success')): ?><div class="pro-alert success"><i class="fas fa-check-circle"></i><?php echo e(session('success')); ?></div><?php endif; ?>
<?php if(session('warning')): ?><div class="pro-alert warning"><i class="fas fa-exclamation-triangle"></i><?php echo e(session('warning')); ?></div><?php endif; ?>
<?php if(session('error')): ?><div class="pro-alert danger"><i class="fas fa-exclamation-circle"></i><?php echo e(session('error')); ?></div><?php endif; ?>

<div class="pg-header">
    <div class="pg-title">
        <div class="icon" style="background:linear-gradient(135deg,#4facfe,#00f2fe)"><i class="fas fa-door-open"></i></div>
        <div><h1>Izin Keluar Siswa</h1><p>Pencatatan izin keluar dan kepulangan siswa</p></div>
    </div>
    <div class="pg-actions">
        <a href="<?php echo e(route('izin-keluar.create')); ?>" class="btn-prim"><i class="fas fa-plus"></i> Tambah Izin</a>
    </div>
</div>

<div class="mini-stats">
    <div class="ms-card"><div class="ms-icon i"><i class="fas fa-door-open"></i></div><div><div class="ms-val"><?php echo e($izinKeluar->count()); ?></div><div class="ms-lbl">Total Izin</div></div></div>
    <div class="ms-card"><div class="ms-icon s"><i class="fas fa-check-circle"></i></div><div><div class="ms-val"><?php echo e($izinKeluar->where('status','kembali')->count()); ?></div><div class="ms-lbl">Sudah Kembali</div></div></div>
    <div class="ms-card"><div class="ms-icon w"><i class="fas fa-spinner"></i></div><div><div class="ms-val"><?php echo e($izinKeluar->where('status','keluar')->count()); ?></div><div class="ms-lbl">Belum Kembali</div></div></div>
</div>

<form method="GET" action="<?php echo e(route('izin-keluar.index')); ?>" class="filter-card mb-4" id="filterForm">
    <div class="row g-3">
        <div class="col-lg-4">
            <div class="filter-search">
                <i class="fas fa-search"></i>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama siswa atau NIS..." class="form-control">
            </div>
        </div>
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center h-100" style="gap:10px">
                <div class="filter-sel" style="flex:1">
                    <select name="status" onchange="this.form.submit()" class="form-select" style="width:100%; border-radius:10px; border:2px solid #e8ecf4; padding:.6rem">
                        <option value="">Semua Status</option>
                        <option value="keluar" <?php echo e(request('status') == 'keluar' ? 'selected' : ''); ?>>Keluar</option>
                        <option value="kembali" <?php echo e(request('status') == 'kembali' ? 'selected' : ''); ?>>Kembali</option>
                    </select>
                </div>
                <button type="button" class="btn-sec" onclick="toggleAdvancedFilter()">
                    <i class="fas fa-filter"></i> Filter Lanjutan
                </button>
                <div class="filter-info"><?php echo e($izinKeluar->count()); ?> izin ditemukan</div>
            </div>
        </div>
    </div>

    <div id="advancedFilter" class="mt-3 p-3 border-top" style="<?php echo e(request('tingkat') || request('jurusan') || request('kelas_detail') ? '' : 'display:none'); ?>">
        <div class="row">
            <div class="col-md-4">
                <h6 class="filter-label">Tingkat</h6>
                <div class="checkbox-group">
                    <?php $__currentLoopData = ['X', 'XI', 'XII']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="check-item">
                        <input type="checkbox" name="tingkat[]" value="<?php echo e($t); ?>" <?php echo e(is_array(request('tingkat')) && in_array($t, request('tingkat')) ? 'checked' : ''); ?> onchange="this.form.submit()">
                        <span>Kelas <?php echo e($t); ?></span>
                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-md-4">
                <h6 class="filter-label">Jurusan</h6>
                <div class="checkbox-group">
                    <?php $__currentLoopData = ['PPLG', 'BCF', 'TO', 'TPFL']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="check-item">
                        <input type="checkbox" name="jurusan[]" value="<?php echo e($j); ?>" <?php echo e(is_array(request('jurusan')) && in_array($j, request('jurusan')) ? 'checked' : ''); ?> onchange="this.form.submit()">
                        <span><?php echo e($j); ?></span>
                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <div class="col-md-4">
                <h6 class="filter-label">Kelas Spesifik</h6>
                <div class="checkbox-group scrollable">
                    <?php
                        $details = [
                            'PPLG 1', 'PPLG 2', 'PPLG 3', 
                            'BCF 1', 'BCF 2', 
                            'TO 1', 'TO 2', 
                            'TPFL 1', 'TPFL 2'
                        ];
                    ?>
                    <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="check-item">
                        <input type="checkbox" name="kelas_detail[]" value="<?php echo e($kd); ?>" <?php echo e(is_array(request('kelas_detail')) && in_array($kd, request('kelas_detail')) ? 'checked' : ''); ?> onchange="this.form.submit()">
                        <span><?php echo e($kd); ?></span>
                    </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <div class="mt-3 text-end">
            <a href="<?php echo e(route('izin-keluar.index')); ?>" class="btn-sec btn-sm">Reset Filter</a>
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
        <h5><i class="fas fa-table"></i> Daftar Izin Keluar</h5>
        <button type="button" id="btnBulkReturn" class="btn-prim s" style="display:none; padding:.4rem .8rem; font-size:.75rem" onclick="executeBulkReturn()">
            <i class="fas fa-check-double"></i> Konfirmasi Kembali Massal (<span id="countSelected">0</span>)
        </button>
    </div>
    <div style="overflow-x:auto">
    <table class="pro-table" id="tbl">
        <thead>
            <tr>
                <th style="width:40px"><input type="checkbox" id="selectAllIzin" style="width:16px; height:16px"></th>
                <th>Siswa</th>
                <th>Kelas</th>
                <th>Alasan</th>
                <th>Waktu Keluar</th>
                <th>Waktu Kembali</th>
                <th>Status</th>
                <th style="text-align:center">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $izinKeluar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $iz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td>
                <?php if($iz->status === 'keluar'): ?>
                    <input type="checkbox" value="<?php echo e($iz->id_izin); ?>" class="izin-cb" style="width:16px; height:16px">
                <?php else: ?>
                    <i class="fas fa-check-circle text-success" style="font-size: 1rem; opacity: 0.5"></i>
                <?php endif; ?>
            </td>
            <td><div style="display:flex;align-items:center;gap:.6rem"><div class="av" style="background:linear-gradient(135deg,#4facfe,#00f2fe)"><?php echo e(strtoupper(substr($iz->siswa->nama??'?',0,1))); ?></div><span style="font-weight:600;color:#2d3748"><?php echo e($iz->siswa->nama??'-'); ?></span></div></td>
            <td><span class="tag p"><?php echo e($iz->siswa->kelas??'-'); ?></span></td>
            <td><span style="font-size:.83rem;color:#718096"><?php echo e(Str::limit($iz->alasan,35)); ?></span></td>
            <td><span style="font-size:.83rem;color:#4a5568"><?php echo e(\Carbon\Carbon::parse($iz->waktu_keluar)->format('d M H:i')); ?></span></td>
            <td><span style="font-size:.83rem;color:#4a5568"><?php echo e($iz->waktu_kembali ? \Carbon\Carbon::parse($iz->waktu_kembali)->format('d M H:i') : '-'); ?></span></td>
            <td>
                <?php if($iz->status==='kembali'): ?><span class="tag s">Kembali</span>
                <?php elseif($iz->status==='keluar'): ?><span class="tag w">Keluar</span>
                <?php else: ?><span class="tag neu"><?php echo e($iz->status); ?></span><?php endif; ?>
            </td>
            <td><div class="act-btns" style="justify-content:center">
                <a href="<?php echo e(route('izin-keluar.show', $iz->id_izin)); ?>" class="ab view" title="Lihat"><i class="fas fa-eye"></i></a>
                <a href="<?php echo e(route('izin-keluar.edit', $iz->id_izin)); ?>" class="ab edit" title="Edit"><i class="fas fa-edit"></i></a>
                <button type="button" class="ab del" onclick="confirmDelete('<?php echo e($iz->id_izin); ?>')" title="Hapus"><i class="fas fa-trash"></i></button>
            </div></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="8"><div class="empty-state"><i class="fas fa-door-open"></i><h5>Tidak ada data izin keluar</h5></div></td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    </div>
    <div class="tbl-foot">
        <span class="info">Menampilkan <?php echo e($izinKeluar->count()); ?> data izin keluar</span>
    </div>
</div>


<form id="deleteForm" method="POST" style="display:none">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('selectAllIzin');
    const checkboxes = document.querySelectorAll('.izin-cb');
    const btnBulkReturn = document.getElementById('btnBulkReturn');
    const countSpan = document.getElementById('countSelected');

    function updateBulkButton() {
        const checked = document.querySelectorAll('.izin-cb:checked').length;
        countSpan.textContent = checked;
        btnBulkReturn.style.display = checked > 0 ? 'inline-flex' : 'none';
    }

    if(selectAll) {
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => {
                cb.checked = selectAll.checked;
            });
            updateBulkButton();
        });
    }

    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateBulkButton);
    });
});

function confirmDelete(id) {
    if (confirm('Apakah Anda yakin ingin menghapus data izin ini?')) {
        const form = document.getElementById('deleteForm');
        form.action = '/izin-keluar/' + id;
        form.submit();
    }
}

async function executeBulkReturn() {
    const checkboxes = document.querySelectorAll('.izin-cb:checked');
    const ids = Array.from(checkboxes).map(cb => cb.value);
    
    if (ids.length === 0) return;

    if (!confirm('Konfirmasi kembali untuk ' + ids.length + ' siswa terpilih?')) {
        return;
    }

    const btn = document.getElementById('btnBulkReturn');
    const originalText = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';

    try {
        const response = await fetch('<?php echo e(route("izin-keluar.bulk-return")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({ ids: ids })
        });

        if (response.ok) {
            window.location.reload();
        } else {
            const data = await response.json();
            alert('Gagal: ' + (data.message || 'Terjadi kesalahan sistem.'));
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan koneksi.');
        btn.disabled = false;
        btn.innerHTML = originalText;
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\antigravity\website-sekolah-main\resources\views/izin-keluar/index.blade.php ENDPATH**/ ?>