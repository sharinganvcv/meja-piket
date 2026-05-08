<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.page-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="pg-wrap">
<?php if(session('success')): ?><div class="pro-alert success"><i class="fas fa-check-circle"></i><?php echo e(session('success')); ?></div><?php endif; ?>
<?php if(session('error')): ?><div class="pro-alert danger"><i class="fas fa-exclamation-circle"></i><?php echo e(session('error')); ?></div><?php endif; ?>

<div class="pg-header">
    <div class="pg-title">
        <div class="icon" style="background:linear-gradient(135deg,#fa709a,#fee140)"><i class="fas fa-exclamation-triangle"></i></div>
        <div><h1>Data Pelanggaran</h1><p>Pencatatan dan rekap pelanggaran siswa</p></div>
    </div>
    <div class="pg-actions">
        <a href="<?php echo e(route('pelanggaran.create')); ?>" class="btn-prim"><i class="fas fa-plus"></i> Catat Pelanggaran</a>
    </div>
</div>

<div class="mini-stats">
    <div class="ms-card"><div class="ms-icon w"><i class="fas fa-exclamation-triangle"></i></div><div><div class="ms-val"><?php echo e($pelanggaran->total()); ?></div><div class="ms-lbl">Total Kasus</div></div></div>
    <div class="ms-card"><div class="ms-icon d"><i class="fas fa-star"></i></div><div><div class="ms-val"><?php echo e($pelanggaran->sum('poin')); ?></div><div class="ms-lbl">Total Poin</div></div></div>
    <div class="ms-card"><div class="ms-icon p"><i class="fas fa-calendar-day"></i></div><div><div class="ms-val"><?php echo e($pelanggaran->where('tanggal',today()->format('Y-m-d'))->count()); ?></div><div class="ms-lbl">Hari Ini</div></div></div>
</div>

<div class="filter-box">
    <div class="filter-search"><i class="fas fa-search"></i><input type="text" id="srch" placeholder="Cari nama siswa atau jenis pelanggaran..."></div>
    <div class="filter-info"><?php echo e($pelanggaran->total()); ?> kasus</div>
</div>

<div class="tbl-card">
    <div class="tbl-head"><h5><i class="fas fa-table"></i> Daftar Pelanggaran</h5></div>
    <div style="overflow-x:auto">
    <table class="pro-table" id="tbl">
        <thead><tr><th>#</th><th>Siswa</th><th>Kelas</th><th>Jenis Pelanggaran</th><th>Tanggal</th><th>Poin</th><th>Dicatat Oleh</th><th style="text-align:center">Aksi</th></tr></thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $pelanggaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($pelanggaran->firstItem() + $i); ?></td>
            <td><div style="display:flex;align-items:center;gap:.6rem"><div class="av" style="background:linear-gradient(135deg,#fa709a,#fee140)"><?php echo e(strtoupper(substr($p->siswa->nama??'?',0,1))); ?></div><span style="font-weight:600;color:#2d3748"><?php echo e($p->siswa->nama??'-'); ?></span></div></td>
            <td><span class="tag p"><?php echo e($p->siswa->kelas??'-'); ?></span></td>
            <td><span style="font-size:.85rem;color:#4a5568"><?php echo e(Str::limit($p->jenis_pelanggaran,35)); ?></span></td>
            <td><span style="font-size:.83rem;color:#718096"><?php echo e(\Carbon\Carbon::parse($p->tanggal)->format('d M Y')); ?></span></td>
            <td><span class="tag <?php echo e($p->poin>=50?'d':($p->poin>=20?'w':'s')); ?>"><?php echo e($p->poin); ?> poin</span></td>
            <td><span style="font-size:.82rem;color:#718096"><?php echo e($p->guru->nama??'-'); ?></span></td>
            <td><div class="act-btns" style="justify-content:center">
                <a href="<?php echo e(route('pelanggaran.show', $p->id)); ?>" class="ab view"><i class="fas fa-eye"></i></a>
                <a href="<?php echo e(route('pelanggaran.edit', $p->id)); ?>" class="ab edit"><i class="fas fa-edit"></i></a>
                <form method="POST" action="<?php echo e(route('pelanggaran.destroy', $p->id)); ?>" style="display:inline" onsubmit="return confirm('Hapus data ini?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="ab del"><i class="fas fa-trash"></i></button></form>
            </div></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="8"><div class="empty-state"><i class="fas fa-check-shield"></i><h5>Tidak ada data pelanggaran</h5><p>Semua siswa berperilaku baik</p></div></td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    </div>
    <div class="tbl-foot">
        <span class="info">Menampilkan <?php echo e($pelanggaran->firstItem()); ?>–<?php echo e($pelanggaran->lastItem()); ?> dari <?php echo e($pelanggaran->total()); ?> data</span>
        <?php echo e($pelanggaran->links()); ?>

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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\antigravity\website-sekolah-main\resources\views/pelanggaran/index.blade.php ENDPATH**/ ?>