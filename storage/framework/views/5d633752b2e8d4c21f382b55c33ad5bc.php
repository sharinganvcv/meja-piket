<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.page-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="pg-wrap">
    <!-- Page Header -->
    <div class="pg-header">
        <div class="pg-title">
            <div class="icon" style="background:linear-gradient(135deg,#f5576c,#f093fb)"><i class="fas fa-exclamation-triangle"></i></div>
            <div>
                <h1>Rekap Pelanggaran</h1>
                <p>Data total pelanggaran dan poin setiap siswa</p>
            </div>
        </div>
        <div class="pg-actions">
            <?php if(auth()->user()->role === 'guru'): ?>
                <a href="<?php echo e(route('pelanggaran.create')); ?>" class="btn-prim">
                    <i class="fas fa-plus"></i> Tambah Pelanggaran
                </a>
            <?php endif; ?>
            <button class="btn-sec" onclick="window.print()">
                <i class="fas fa-print"></i> Cetak PDF
            </button>
            <a href="<?php echo e(route('pelanggaran.index')); ?>" class="btn-sec">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="mini-stats">
        <div class="ms-card">
            <div class="ms-icon p"><i class="fas fa-users"></i></div>
            <div>
                <div class="ms-val"><?php echo e($rekap->count()); ?></div>
                <div class="ms-lbl">Total Siswa</div>
            </div>
        </div>
        <div class="ms-card">
            <div class="ms-icon w"><i class="fas fa-exclamation-circle"></i></div>
            <div>
                <div class="ms-val"><?php echo e($rekap->sum('jumlah_pelanggaran')); ?></div>
                <div class="ms-lbl">Total Pelanggaran</div>
            </div>
        </div>
        <div class="ms-card">
            <div class="ms-icon d"><i class="fas fa-chart-line"></i></div>
            <div>
                <div class="ms-val"><?php echo e(number_format($rekap->avg('total_poin'), 1)); ?></div>
                <div class="ms-lbl">Rata-rata Poin</div>
            </div>
        </div>
        <div class="ms-card">
            <div class="ms-icon s"><i class="fas fa-trophy"></i></div>
            <div>
                <div class="ms-val"><?php echo e($rekap->max('total_poin') ?? 0); ?></div>
                <div class="ms-lbl">Poin Tertinggi</div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="tbl-card">
        <div class="tbl-head">
            <h5><i class="fas fa-table"></i> Data Rekap Pelanggaran</h5>
        </div>
        <div style="overflow-x:auto">
            <table class="pro-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>Nama Siswa</th>
                        <th style="text-align:center;">Jumlah Pelanggaran</th>
                        <th style="text-align:center;">Total Poin</th>
                        <th style="text-align:center;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $rekap; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($index + 1); ?></td>
                            <td>
                                <div style="display:flex;align-items:center;gap:.6rem">
                                    <div class="av" style="background:linear-gradient(135deg,#f5576c,#f093fb)">
                                        <?php echo e(strtoupper(substr($item->siswa->nama ?? '?',0,1))); ?>

                                    </div>
                                    <span style="font-weight:600;color:#2d3748"><?php echo e($item->siswa->nama ?? '-'); ?></span>
                                </div>
                            </td>
                            <td style="text-align:center;">
                                <span class="tag w"><?php echo e($item->jumlah_pelanggaran); ?> Kali</span>
                            </td>
                            <td style="text-align:center;">
                                <span class="tag d"><?php echo e($item->total_poin); ?> Poin</span>
                            </td>
                            <td style="text-align:center;">
                                <?php if($item->total_poin > 15): ?>
                                    <span class="tag d">Bermasalah</span>
                                <?php elseif($item->total_poin >= 10): ?>
                                    <span class="tag w">Peringatan</span>
                                <?php else: ?>
                                    <span class="tag s">Baik</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <h5>Tidak ada data pelanggaran</h5>
                                    <p>Silakan tambahkan data pelanggaran terlebih dahulu</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\antigravity\website-sekolah-main\resources\views/pelanggaran/rekap.blade.php ENDPATH**/ ?>