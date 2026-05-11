<?php $__env->startSection('content'); ?>
    <div class="py-4">
        <h2 class="mb-4" style="color: #64748b;">Tambah Siswa</h2>
        
        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(route('siswa.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <div class="mb-3">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="text" class="form-control <?php $__errorArgs = ['nis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="nis" name="nis" value="<?php echo e(old('nis')); ?>" required>
                        <?php $__errorArgs = ['nis'];
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
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="nama" name="nama" value="<?php echo e(old('nama')); ?>" required>
                        <?php $__errorArgs = ['nama'];
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
                        <label for="kelas" class="form-label">Kelas</label>
                        <select name="kelas" id="kelas" class="form-select <?php $__errorArgs = ['kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                            <option value="">Pilih Kelas</option>
                            <option value="X PPLG 1" <?php echo e(old('kelas') == 'X PPLG 1' ? 'selected' : ''); ?>>X PPLG 1</option>
                            <option value="X PPLG 2" <?php echo e(old('kelas') == 'X PPLG 2' ? 'selected' : ''); ?>>X PPLG 2</option>
                            <option value="X PPLG 3" <?php echo e(old('kelas') == 'X PPLG 3' ? 'selected' : ''); ?>>X PPLG 3</option>
                            <option value="XI PPLG 1" <?php echo e(old('kelas') == 'XI PPLG 1' ? 'selected' : ''); ?>>XI PPLG 1</option>
                            <option value="XI PPLG 2" <?php echo e(old('kelas') == 'XI PPLG 2' ? 'selected' : ''); ?>>XI PPLG 2</option>
                            <option value="XI PPLG 3" <?php echo e(old('kelas') == 'XI PPLG 3' ? 'selected' : ''); ?>>XI PPLG 3</option>
                            <option value="XII PPLG 1" <?php echo e(old('kelas') == 'XII PPLG 1' ? 'selected' : ''); ?>>XII PPLG 1</option>
                            <option value="XII PPLG 2" <?php echo e(old('kelas') == 'XII PPLG 2' ? 'selected' : ''); ?>>XII PPLG 2</option>
                            <option value="XII PPLG 3" <?php echo e(old('kelas') == 'XII PPLG 3' ? 'selected' : ''); ?>>XII PPLG 3</option>
                            <option value="X BCF 1" <?php echo e(old('kelas') == 'X BCF 1' ? 'selected' : ''); ?>>X BCF 1</option>
                            <option value="X BCF 2" <?php echo e(old('kelas') == 'X BCF 2' ? 'selected' : ''); ?>>X BCF 2</option>
                            <option value="XI BCF 1" <?php echo e(old('kelas') == 'XI BCF 1' ? 'selected' : ''); ?>>XI BCF 1</option>
                            <option value="XI BCF 2" <?php echo e(old('kelas') == 'XI BCF 2' ? 'selected' : ''); ?>>XI BCF 2</option>
                            <option value="XII BCF 1" <?php echo e(old('kelas') == 'XII BCF 1' ? 'selected' : ''); ?>>XII BCF 1</option>
                            <option value="XII BCF 2" <?php echo e(old('kelas') == 'XII BCF 2' ? 'selected' : ''); ?>>XII BCF 2</option>
                            <option value="X TPFL" <?php echo e(old('kelas') == 'X TPFL' ? 'selected' : ''); ?>>X TPFL</option>
                            <option value="XI TPFL 1" <?php echo e(old('kelas') == 'XI TPFL 1' ? 'selected' : ''); ?>>XI TPFL 1</option>
                            <option value="XI TPFL 2" <?php echo e(old('kelas') == 'XI TPFL 2' ? 'selected' : ''); ?>>XI TPFL 2</option>
                            <option value="XII TPFL" <?php echo e(old('kelas') == 'XII TPFL' ? 'selected' : ''); ?>>XII TPFL</option>
                            <option value="XI TPFL 1" <?php echo e(old('kelas') == 'XI TPFL 1' ? 'selected' : ''); ?>>XI TPFL 1</option>
                            <option value="XI TPFL 2" <?php echo e(old('kelas') == 'XI TPFL 2' ? 'selected' : ''); ?>>XI TPFL 2</option>
                            <option value="XII TPFL" <?php echo e(old('kelas') == 'XII TPFL' ? 'selected' : ''); ?>>XII TPFL</option>
                            <option value="X TO 1" <?php echo e(old('kelas') == 'X TO 1' ? 'selected' : ''); ?>>X TO 1</option>
                            <option value="X TO 2" <?php echo e(old('kelas') == 'X TO 2' ? 'selected' : ''); ?>>X TO 2</option>
                            <option value="XI TO 1" <?php echo e(old('kelas') == 'XI TO 1' ? 'selected' : ''); ?>>XI TO 1</option>
                            <option value="XI TO 2" <?php echo e(old('kelas') == 'XI TO 2' ? 'selected' : ''); ?>>XI TO 2</option>
                            <option value="XII TO" <?php echo e(old('kelas') == 'XII TO' ? 'selected' : ''); ?>>XII TO</option>
                        </select>
                        <?php $__errorArgs = ['kelas'];
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
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?php echo e(route('siswa.index')); ?>" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\antigravity\website-sekolah-main\resources\views/siswa/create.blade.php ENDPATH**/ ?>