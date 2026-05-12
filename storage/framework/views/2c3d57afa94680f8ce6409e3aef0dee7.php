<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.page-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="pg-wrap">
    <div class="pg-header">
        <div class="pg-title">
            <div class="icon" style="background: linear-gradient(135deg, #f43f5e 0%, #fb923c 100%)">
                <i class="fas fa-file-invoice"></i>
            </div>
            <div>
                <h1>Laporan Keterlambatan</h1>
                <p>Rekapitulasi data siswa terlambat</p>
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
            <div class="ms-icon i"><i class="fas fa-clock"></i></div>
            <div>
                <div class="ms-val"><?php echo e($totalKeterlambatan); ?></div>
                <div class="ms-lbl">Total Terlambat</div>
            </div>
        </div>
        <div class="ms-card">
            <div class="ms-icon w"><i class="fas fa-calendar-day"></i></div>
            <div>
                <div class="ms-val"><?php echo e($keterlambatanBulanIni); ?></div>
                <div class="ms-lbl">Bulan Ini</div>
            </div>
        </div>
        <div class="ms-card">
            <div class="ms-icon s"><i class="fas fa-hourglass-half"></i></div>
            <div>
                <div class="ms-val"><?php echo e(round($rerataDurasi ?? 0, 1)); ?></div>
                <div class="ms-lbl">Rerata Menit</div>
            </div>
        </div>
    </div>

    <div class="tbl-card">
        <div class="tbl-head">
            <h5><i class="fas fa-table"></i> Data Keterlambatan</h5>
        </div>
        <div style="overflow-x:auto">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Siswa</th>
                        <th>Kelas</th>
                        <th>Waktu Datang</th>
                        <th>Durasi</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $keterlambatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $kt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($keterlambatan->firstItem() + $i); ?></td>
                        <td>
                            <div style="display:flex;align-items:center;gap:.6rem">
                                <div class="av" style="background:linear-gradient(135deg,#f43f5e,#fb923c)">
                                    <?php echo e(strtoupper(substr($kt->siswa->nama??'?',0,1))); ?>

                                </div>
                                <span style="font-weight:600;color:#2d3748"><?php echo e($kt->siswa->nama??'-'); ?></span>
                            </div>
                        </td>
                        <td><span class="tag p"><?php echo e($kt->siswa->kelas??'-'); ?></span></td>
                        <td><span style="font-size:.83rem;color:#4a5568"><?php echo e(\Carbon\Carbon::parse($kt->waktu_datang)->format('d M Y H:i')); ?></span></td>
                        <td><span class="tag w"><?php echo e($kt->durasi); ?> Menit</span></td>
                        <td><span style="font-size:.83rem;color:#718096"><?php echo e($kt->keterangan ?? '-'); ?></span></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="fas fa-clock"></i>
                                <h5>Belum ada data laporan</h5>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="tbl-foot">
            <?php echo e($keterlambatan->links()); ?>

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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\antigravity\website-sekolah-main\resources\views/laporan/keterlambatan.blade.php ENDPATH**/ ?>