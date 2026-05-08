<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.page-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="pg-wrap">
<?php if(session('success')): ?><div class="pro-alert success"><i class="fas fa-check-circle"></i><?php echo e(session('success')); ?></div><?php endif; ?>
<?php if(session('error')): ?><div class="pro-alert danger"><i class="fas fa-exclamation-circle"></i><?php echo e(session('error')); ?></div><?php endif; ?>

<div class="pg-header">
    <div class="pg-title">
        <div class="icon" style="background:linear-gradient(135deg,#43e97b,#38f9d7)"><i class="fas fa-chalkboard-teacher"></i></div>
        <div><h1>Data Guru</h1><p>Kelola seluruh data guru & tenaga pengajar</p></div>
    </div>
    <div class="pg-actions">
        <?php if(auth()->user()->role==='admin'): ?>
        <a href="<?php echo e(route('guru.create')); ?>" class="btn-prim"><i class="fas fa-plus"></i> Tambah Guru</a>
        <?php endif; ?>
    </div>
</div>

<div class="mini-stats">
    <div class="ms-card"><div class="ms-icon p"><i class="fas fa-chalkboard-teacher"></i></div><div><div class="ms-val"><?php echo e($guru->total()); ?></div><div class="ms-lbl">Total Guru</div></div></div>
    <div class="ms-card"><div class="ms-icon s"><i class="fas fa-user-check"></i></div><div><div class="ms-val"><?php echo e($guru->total()); ?></div><div class="ms-lbl">Aktif</div></div></div>
</div>

<div class="filter-box">
    <div class="filter-search"><i class="fas fa-search"></i><input type="text" id="srch" placeholder="Cari nama atau jabatan..."></div>
    <div class="filter-info"><?php echo e($guru->total()); ?> guru ditemukan</div>
</div>

<div class="tbl-card">
    <div class="tbl-head"><h5><i class="fas fa-table"></i> Daftar Guru</h5></div>
    <div style="overflow-x:auto">
    <table class="pro-table" id="tbl">
        <thead><tr><th>#</th><th>Nama Guru</th><th>Jabatan</th><th style="text-align:center">Aksi</th></tr></thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $guru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($guru->firstItem() + $i); ?></td>
            <td><div style="display:flex;align-items:center;gap:.6rem"><div class="av" style="background:linear-gradient(135deg,#43e97b,#38f9d7)"><?php echo e(strtoupper(substr($g->nama,0,1))); ?></div><span style="font-weight:600;color:#2d3748"><?php echo e($g->nama); ?></span></div></td>
            <td><span class="tag s"><?php echo e($g->jabatan ?? '-'); ?></span></td>
            <td><div class="act-btns" style="justify-content:center">
                <a href="<?php echo e(route('guru.show', $g->id_guru)); ?>" class="ab view"><i class="fas fa-eye"></i></a>
                <?php if(auth()->user()->role==='admin'): ?>
                <a href="<?php echo e(route('guru.edit', $g->id_guru)); ?>" class="ab edit"><i class="fas fa-edit"></i></a>
                <form method="POST" action="<?php echo e(route('guru.destroy', $g->id_guru)); ?>" style="display:inline" onsubmit="return confirm('Hapus guru ini?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="ab del"><i class="fas fa-trash"></i></button></form>
                <?php endif; ?>
            </div></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="4"><div class="empty-state"><i class="fas fa-chalkboard-teacher"></i><h5>Belum ada data guru</h5></div></td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    </div>
    <div class="tbl-foot">
        <span class="info">Menampilkan <?php echo e($guru->firstItem()); ?>–<?php echo e($guru->lastItem()); ?> dari <?php echo e($guru->total()); ?> data</span>
        <?php echo e($guru->links()); ?>

    </div>
</div>
</div>
<script>
document.getElementById('srch').addEventListener('input',function(){
    const s=this.value.toLowerCase();
    document.querySelectorAll('#tbl tbody tr').forEach(r=>{r.style.display=r.textContent.toLowerCase().includes(s)?'':'none'});
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\antigravity\website-sekolah-main\resources\views/guru/index.blade.php ENDPATH**/ ?>