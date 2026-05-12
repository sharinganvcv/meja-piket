<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.page-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="pg-wrap">
<?php if(session('success')): ?><div class="pro-alert success"><i class="fas fa-check-circle"></i><?php echo e(session('success')); ?></div><?php endif; ?>
<?php if(session('error')): ?><div class="pro-alert danger"><i class="fas fa-exclamation-circle"></i><?php echo e(session('error')); ?></div><?php endif; ?>

<div class="pg-header">
    <div class="pg-title">
        <div class="icon" style="background:linear-gradient(135deg,#f5576c,#f093fb)"><i class="fas fa-clock"></i></div>
        <div><h1>Data Keterlambatan</h1><p>Pencatatan siswa yang datang terlambat</p></div>
    </div>
    <div class="pg-actions">
        <a href="<?php echo e(route('keterlambatan.create')); ?>" class="btn-prim"><i class="fas fa-plus"></i> Catat Keterlambatan</a>
    </div>
</div>

<div class="mini-stats">
    <div class="ms-card"><div class="ms-icon d"><i class="fas fa-clock"></i></div><div><div class="ms-val"><?php echo e($keterlambatan->total()); ?></div><div class="ms-lbl">Total Kasus</div></div></div>
    <div class="ms-card"><div class="ms-icon w"><i class="fas fa-calendar-day"></i></div><div><div class="ms-val"><?php echo e($keterlambatan->where('waktu_datang','>=',today())->count()); ?></div><div class="ms-lbl">Hari Ini</div></div></div>
    <div class="ms-card"><div class="ms-icon p"><i class="fas fa-calendar-week"></i></div><div><div class="ms-val"><?php echo e($keterlambatan->where('waktu_datang','>=',now()->startOfWeek())->count()); ?></div><div class="ms-lbl">Minggu Ini</div></div></div>
</div>

<div class="filter-box">
    <div class="filter-search"><i class="fas fa-search"></i><input type="text" id="srch" placeholder="Cari nama siswa..."></div>
    <div class="filter-info"><?php echo e($keterlambatan->total()); ?> kasus</div>
</div>

<div class="tbl-card">
    <div class="tbl-head"><h5><i class="fas fa-table"></i> Daftar Keterlambatan</h5></div>
    <div style="overflow-x:auto">
    <table class="pro-table" id="tbl">
        <thead><tr><th>#</th><th>Siswa</th><th>Kelas</th><th>Waktu Datang</th><th>Durasi</th><th>Keterangan</th><th>Dicatat Oleh</th><th style="text-align:center">Aksi</th></tr></thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $keterlambatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
            <td><?php echo e($keterlambatan->firstItem() + $i); ?></td>
            <td><div style="display:flex;align-items:center;gap:.6rem"><div class="av" style="background:linear-gradient(135deg,#f5576c,#f093fb)"><?php echo e(strtoupper(substr($k->siswa->nama??'?',0,1))); ?></div><span style="font-weight:600;color:#2d3748"><?php echo e($k->siswa->nama??'-'); ?></span></div></td>
            <td><span class="tag p"><?php echo e($k->siswa->kelas??'-'); ?></span></td>
            <td><span style="font-size:.85rem;color:#4a5568"><?php echo e(\Carbon\Carbon::parse($k->waktu_datang)->format('d M Y H:i')); ?></span></td>
            <td><span class="tag w"><?php echo e($k->durasi); ?> Min</span></td>
            <td><span style="color:#718096;font-size:.85rem"><?php echo e(Str::limit($k->keterangan,40) ?? '-'); ?></span></td>
            <td><span style="color:#718096;font-size:.82rem"><?php echo e($k->guru->nama??'-'); ?></span></td>
            <td><div class="act-btns" style="justify-content:center">
                <a href="<?php echo e(route('keterlambatan.show', $k->id_telat)); ?>" class="ab view"><i class="fas fa-eye"></i></a>
                <a href="<?php echo e(route('keterlambatan.edit', $k->id_telat)); ?>" class="ab edit"><i class="fas fa-edit"></i></a>
                <form method="POST" action="<?php echo e(route('keterlambatan.destroy', $k->id_telat)); ?>" style="display:inline" onsubmit="return confirm('Hapus data ini?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button type="submit" class="ab del"><i class="fas fa-trash"></i></button></form>
            </div></td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr><td colspan="7"><div class="empty-state"><i class="fas fa-clock"></i><h5>Tidak ada keterlambatan</h5><p>Semua siswa hadir tepat waktu</p></div></td></tr>
        <?php endif; ?>
        </tbody>
    </table>
    </div>
    <div class="tbl-foot">
        <span class="info">Menampilkan <?php echo e($keterlambatan->firstItem()); ?>–<?php echo e($keterlambatan->lastItem()); ?> dari <?php echo e($keterlambatan->total()); ?> data</span>
        <?php echo e($keterlambatan->links()); ?>

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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\antigravity\website-sekolah-main\resources\views/keterlambatan/index.blade.php ENDPATH**/ ?>