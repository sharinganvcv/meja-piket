<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.page-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="pg-wrap">
<?php if(session('success')): ?><div class="pro-alert success"><i class="fas fa-check-circle"></i><?php echo e(session('success')); ?></div><?php endif; ?>
<?php if(session('error')): ?><div class="pro-alert danger"><i class="fas fa-exclamation-circle"></i><?php echo e(session('error')); ?></div><?php endif; ?>

<div class="pg-header">
    <div class="pg-title">
        <div class="icon"><i class="fas fa-users"></i></div>
        <div><h1>Data Siswa</h1><p>Kelola seluruh data siswa sekolah</p></div>
    </div>
    <div class="pg-actions">
        <?php if(auth()->user()->role === 'admin'): ?>
        <a href="<?php echo e(route('siswa.create')); ?>" class="btn-prim"><i class="fas fa-plus"></i> Tambah Siswa</a>
        <?php endif; ?>
    </div>
</div>

<div class="mini-stats">
    <div class="ms-card"><div class="ms-icon p"><i class="fas fa-users"></i></div><div><div class="ms-val"><?php echo e($totalSiswa); ?></div><div class="ms-lbl">Total Siswa</div></div></div>
    <div class="ms-card"><div class="ms-icon s"><i class="fas fa-graduation-cap"></i></div><div><div class="ms-val"><?php echo e($countX); ?></div><div class="ms-lbl">Kelas X</div></div></div>
    <div class="ms-card"><div class="ms-icon w"><i class="fas fa-graduation-cap"></i></div><div><div class="ms-val"><?php echo e($countXI); ?></div><div class="ms-lbl">Kelas XI</div></div></div>
    <div class="ms-card"><div class="ms-icon i"><i class="fas fa-graduation-cap"></i></div><div><div class="ms-val"><?php echo e($countXII); ?></div><div class="ms-lbl">Kelas XII</div></div></div>
</div>

<form method="GET" action="<?php echo e(route('siswa.index')); ?>" class="filter-box" id="filterForm">
    <div class="filter-search">
        <i class="fas fa-search"></i>
        <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama atau NIS...">
    </div>
    <div class="filter-sel">
        <select name="kelas" onchange="document.getElementById('filterForm').submit()">
            <option value="">Semua Kelas</option>
            <option value="X" <?php echo e(request('kelas') == 'X' ? 'selected' : ''); ?>>Kelas X</option>
            <option value="XI" <?php echo e(request('kelas') == 'XI' ? 'selected' : ''); ?>>Kelas XI</option>
            <option value="XII" <?php echo e(request('kelas') == 'XII' ? 'selected' : ''); ?>>Kelas XII</option>
        </select>
    </div>
    <div class="filter-info"><?php echo e($siswa->total()); ?> siswa ditemukan</div>
</form>

<div class="tbl-card">
    <div class="tbl-head"><h5><i class="fas fa-table"></i> Daftar Siswa</h5></div>
    <div style="overflow-x:auto">
    <table class="pro-table" id="tbl">
        <thead><tr><th>#</th><th>NIS</th><th>Nama Siswa</th><th>Kelas</th><th>Jurusan</th><th style="text-align:center">Aksi</th></tr></thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($siswa->firstItem() + $i); ?></td>
            <td><span class="tag neu"><?php echo e($s->nis); ?></span></td>
            <td><div style="display:flex;align-items:center;gap:.6rem"><div class="av"><?php echo e(strtoupper(substr($s->nama,0,1))); ?></div><span style="font-weight:600;color:#2d3748"><?php echo e($s->nama); ?></span></div></td>
            <td><span class="tag p"><?php echo e($s->kelas); ?></span></td>
            <td><span style="color:#718096;font-size:.85rem"><?php echo e($s->jurusan ?? '-'); ?></span></td>
            <td><div class="act-btns" style="justify-content:center">
                <a href="<?php echo e(route('siswa.show', $s->id_siswa)); ?>" class="ab view" title="Detail"><i class="fas fa-eye"></i></a>
                <?php if(auth()->user()->role==='admin'): ?>
                <a href="<?php echo e(route('siswa.edit', $s->id_siswa)); ?>" class="ab edit" title="Edit"><i class="fas fa-edit"></i></a>
                <form method="POST" action="<?php echo e(route('siswa.destroy', $s->id_siswa)); ?>" style="display:inline" onsubmit="return confirm('Hapus siswa ini?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="ab del" title="Hapus"><i class="fas fa-trash"></i></button></form>
                <?php endif; ?>
            </div></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="6"><div class="empty-state"><i class="fas fa-users"></i><h5>Belum ada data siswa</h5><p>Tambahkan siswa baru untuk memulai</p></div></td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    </div>
    <div class="tbl-foot">
        <span class="info">Menampilkan <?php echo e($siswa->firstItem()); ?>–<?php echo e($siswa->lastItem()); ?> dari <?php echo e($siswa->total()); ?> data</span>
        <?php echo e($siswa->links()); ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\antigravity\website-sekolah-main\resources\views/siswa/index.blade.php ENDPATH**/ ?>