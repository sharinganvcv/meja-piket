<?php $__env->startSection('content'); ?>
<div class="py-4">
    <h2 class="mb-4" style="color: var(--primary-color);">Edit Izin Keluar</h2>
    
    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('izin-keluar.update', $izinKeluar)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <div class="mb-3">
                    <label class="form-label">Siswa</label>
                    <input type="text" class="form-control" value="<?php echo e($izinKeluar->siswa->nama); ?> (<?php echo e($izinKeluar->siswa->kelas); ?>)" readonly disabled>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Guru Piket</label>
                    <input type="text" class="form-control" value="<?php echo e($izinKeluar->guru->nama); ?>" readonly disabled>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Alasan</label>
                    <textarea class="form-control" rows="3" readonly disabled><?php echo e($izinKeluar->alasan); ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Waktu Keluar</label>
                    <input type="text" class="form-control" value="<?php echo e($izinKeluar->waktu_keluar->format('d/m/Y H:i')); ?>" readonly disabled>
                </div>
                
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                            id="status" name="status" required>
                        <option value="pending" <?php echo e(old('status', $izinKeluar->status) == 'pending' ? 'selected' : ''); ?>>Pending</option>
                        <option value="approved" <?php echo e(old('status', $izinKeluar->status) == 'approved' ? 'selected' : ''); ?>>Setujui</option>
                        <option value="rejected" <?php echo e(old('status', $izinKeluar->status) == 'rejected' ? 'selected' : ''); ?>>Tolak</option>
                        <option value="completed" <?php echo e(old('status', $izinKeluar->status) == 'completed' ? 'selected' : ''); ?>>Selesai</option>
                    </select>
                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="mb-3">
                    <label for="waktu_kembali" class="form-label">Waktu Kembali</label>
                    <input type="datetime-local" class="form-control <?php $__errorArgs = ['waktu_kembali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                           id="waktu_kembali" name="waktu_kembali" 
                           value="<?php echo e(old('waktu_kembali', $izinKeluar->waktu_kembali ? $izinKeluar->waktu_kembali->format('Y-m-d\TH:i') : '')); ?>">
                    <?php $__errorArgs = ['waktu_kembali'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <small class="text-muted">Kosongkan jika belum kembali</small>
                </div>
                
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="<?php echo e(route('izin-keluar.index')); ?>" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\antigravity\website-sekolah-main\resources\views/izin-keluar/edit.blade.php ENDPATH**/ ?>