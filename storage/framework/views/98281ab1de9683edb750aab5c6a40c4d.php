<?php $__env->startSection('content'); ?>
    <div class="py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0" style="color: var(--primary-color);">Detail Pelanggaran</h2>
            <a href="<?php echo e(route('pelanggaran.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
        
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Siswa</label>
                            <p class="form-control-plaintext"><?php echo e($pelanggaran->siswa->nama ?? 'Tidak ada'); ?></p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">NIS</label>
                            <p class="form-control-plaintext"><?php echo e($pelanggaran->siswa->nis ?? 'Tidak ada'); ?></p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tanggal</label>
                            <p class="form-control-plaintext"><?php echo e($pelanggaran->tanggal->format('d/m/Y')); ?></p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jenis Pelanggaran</label>
                            <p class="form-control-plaintext"><?php echo e($pelanggaran->jenis_pelanggaran); ?></p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Poin</label>
                            <p class="form-control-plaintext">
                                <span class="badge bg-danger"><?php echo e($pelanggaran->poin); ?></span>
                            </p>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Guru</label>
                            <p class="form-control-plaintext"><?php echo e($pelanggaran->guru->nama ?? 'Tidak ada'); ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Keterangan</label>
                    <p class="form-control-plaintext"><?php echo e($pelanggaran->keterangan ?? 'Tidak ada keterangan'); ?></p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Sanksi</label>
                    <p class="form-control-plaintext"><?php echo e($pelanggaran->sanksi ?? 'Tidak ada sanksi'); ?></p>
                </div>
                
                <div class="mt-4">
                    <a href="<?php echo e(route('pelanggaran.edit', $pelanggaran)); ?>" class="btn btn-primary">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <form method="POST" action="<?php echo e(route('pelanggaran.destroy', $pelanggaran)); ?>" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data pelanggaran ini?')">
                            <i class="fas fa-trash me-2"></i>Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\antigravity\website-sekolah-main\resources\views/pelanggaran/show.blade.php ENDPATH**/ ?>