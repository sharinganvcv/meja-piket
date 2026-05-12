<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.page-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="pg-wrap">
    <div class="pg-header">
        <div class="pg-title">
            <div class="icon" style="background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%)">
                <i class="fas fa-file-medical-alt"></i>
            </div>
            <div>
                <h1>Laporan Pelanggaran</h1>
                <p>Rekapitulasi data pelanggaran siswa</p>
            </div>
        </div>
        <div class="pg-actions">
            <button onclick="window.print()" class="btn-prim">
                <i class="fas fa-print"></i> Cetak Laporan
            </button>
        </div>
    </div>

    <div class="mini-stats">
        <div class="ms-card">
            <div class="ms-icon i"><i class="fas fa-exclamation-triangle"></i></div>
            <div>
                <div class="ms-val"><?php echo e($totalPelanggaran); ?></div>
                <div class="ms-lbl">Total Pelanggaran</div>
            </div>
        </div>
        <div class="ms-card">
            <div class="ms-icon w"><i class="fas fa-calendar-minus"></i></div>
            <div>
                <div class="ms-val"><?php echo e($pelanggaranBulanIni); ?></div>
                <div class="ms-lbl">Bulan Ini</div>
            </div>
        </div>
        <div class="ms-card">
            <div class="ms-icon s"><i class="fas fa-star-half-alt"></i></div>
            <div>
                <div class="ms-val"><?php echo e($totalPoin); ?></div>
                <div class="ms-lbl">Total Poin</div>
            </div>
        </div>
    </div>

    <div class="tbl-card">
        <div class="tbl-head">
            <h5><i class="fas fa-table"></i> Data Pelanggaran</h5>
        </div>
        <div style="overflow-x:auto">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Poin</th>
                        <th>Sanksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $pelanggaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $pl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($pelanggaran->firstItem() + $i); ?></td>
                        <td>
                            <div style="display:flex;align-items:center;gap:.6rem">
                                <div class="av" style="background:linear-gradient(135deg,#ef4444,#b91c1c)">
                                    <?php echo e(strtoupper(substr($pl->siswa->nama??'?',0,1))); ?>

                                </div>
                                <span style="font-weight:600;color:#2d3748"><?php echo e($pl->siswa->nama??'-'); ?></span>
                            </div>
                        </td>
                        <td><span class="tag p"><?php echo e($pl->siswa->kelas??'-'); ?></span></td>
                        <td><span style="font-size:.83rem;color:#4a5568"><?php echo e(\Carbon\Carbon::parse($pl->tanggal)->format('d M Y')); ?></span></td>
                        <td><span style="font-size:.83rem;color:#718096"><?php echo e($pl->jenis_pelanggaran); ?></span></td>
                        <td><span class="tag d"><?php echo e($pl->poin); ?></span></td>
                        <td><span style="font-size:.83rem;color:#718096"><?php echo e($pl->sanksi ?? '-'); ?></span></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="fas fa-exclamation-circle"></i>
                                <h5>Belum ada data laporan</h5>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="tbl-foot">
            <?php echo e($pelanggaran->links()); ?>

        </div>
    </div>
</div>

<style>
    @media print {
        .sidebar, .pg-actions, .tbl-foot, .filter-box { display: none !important; }
        .main-content { margin-left: 0 !important; }
        .pg-wrap { padding: 0 !important; }
        .tbl-card { border: none !important; box-shadow: none !important; }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\antigravity\website-sekolah-main\resources\views/laporan/pelanggaran.blade.php ENDPATH**/ ?>