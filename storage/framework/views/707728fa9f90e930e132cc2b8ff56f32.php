<?php $__env->startSection('content'); ?>
    <div class="py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0" style="color: var(--primary-color);">Detail Izin Keluar</h2>
            <a href="<?php echo e(route('izin-keluar.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
        
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Siswa</label>
                            <p class="form-control-plaintext"><?php echo e($izinKeluar->siswa->nama); ?> (<?php echo e($izinKeluar->siswa->nis); ?>)</p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Guru</label>
                            <p class="form-control-plaintext"><?php echo e($izinKeluar->guru->nama); ?></p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Alasan</label>
                            <p class="form-control-plaintext"><?php echo e($izinKeluar->alasan); ?></p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Waktu Keluar</label>
                            <p class="form-control-plaintext"><?php echo e($izinKeluar->waktu_keluar); ?></p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Status</label>
                            <p class="form-control-plaintext">
                                <?php if($izinKeluar->status === 'approved'): ?>
                                    <span class="badge bg-success">Disetujui</span>
                                <?php elseif($izinKeluar->status === 'rejected'): ?>
                                    <span class="badge bg-danger">Ditolak</span>
                                <?php elseif($izinKeluar->status === 'completed'): ?>
                                    <span class="badge bg-info">Selesai</span>
                                <?php else: ?>
                                    <span class="badge bg-warning">Pending</span>
                                <?php endif; ?>
                            </p>
                        </div>
                        
                        <?php if($izinKeluar->waktu_kembali): ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Waktu Kembali</label>
                            <p class="form-control-plaintext"><?php echo e($izinKeluar->waktu_kembali); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="mt-4">
                    <a href="<?php echo e(route('izin-keluar.edit', $izinKeluar)); ?>" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\antigravity\website-sekolah-main\resources\views/izin-keluar/show.blade.php ENDPATH**/ ?>