<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.page-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<div class="pg-wrap py-4">
    <div class="pg-header">
        <div class="pg-title">
            <div class="icon" style="background:linear-gradient(135deg,#4facfe,#00f2fe)"><i class="fas fa-door-open"></i></div>
            <div><h1>Ajukan Izin Keluar</h1><p>Pilih satu atau banyak siswa sekaligus</p></div>
        </div>
        <div class="pg-actions">
            <a href="<?php echo e(route('izin-keluar.index')); ?>" class="btn-sec"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
    </div>
    
    <form action="<?php echo e(route('izin-keluar.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-lg-8">
                <div class="tbl-card">
                    <div class="tbl-head d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-users"></i> Pilih Siswa</h5>
                        <div class="d-flex gap-2">
                            <input type="text" id="siswaSearch" placeholder="Cari nama/NIS..." class="pro-input" style="width:180px; padding:.4rem .8rem">
                            <select id="kelasFilter" class="pro-select" style="width:120px; padding:.4rem">
                                <option value="">Tingkat</option>
                                <option value="X">Kelas X</option>
                                <option value="XI">Kelas XI</option>
                                <option value="XII">Kelas XII</option>
                            </select>
                            <select id="jurusanFilter" class="pro-select" style="width:120px; padding:.4rem">
                                <option value="">Jurusan</option>
                                <option value="PPLG">PPLG</option>
                                <option value="BCF">BCF</option>
                                <option value="TO">TO</option>
                                <option value="TPFL">TPFL</option>
                            </select>
                        </div>
                    </div>
                    <div style="max-height: 500px; overflow-y: auto;">
                        <table class="pro-table" id="siswaTable">
                            <thead>
                                <tr>
                                    <th style="width: 40px;"><input type="checkbox" id="selectAll" style="width:18px; height:18px"></th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="siswa-row" data-kelas="<?php echo e($s->kelas); ?>">
                                    <td><input type="checkbox" name="id_siswa[]" value="<?php echo e($s->id_siswa); ?>" class="siswa-checkbox" style="width:18px; height:18px"></td>
                                    <td><span class="tag neu"><?php echo e($s->nis); ?></span></td>
                                    <td><strong><?php echo e($s->nama); ?></strong></td>
                                    <td><span class="tag p"><?php echo e($s->kelas); ?></span></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tbl-foot">
                        <span id="selectedCount" class="info">0 siswa dipilih</span>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="form-card">
                    <h6 class="form-section-title">Detail Izin</h6>
                    
                    <div class="mb-3">
                        <label for="id_guru" class="pro-label">Guru Pemberi Izin</label>
                        <select class="pro-select <?php $__errorArgs = ['id_guru'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="id_guru" name="id_guru" required>
                            <option value="">-- Pilih Guru --</option>
                            <?php $__currentLoopData = $guru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($g->id_guru); ?>" <?php echo e(old('id_guru') == $g->id_guru ? 'selected' : ''); ?>>
                                    <?php echo e($g->nama); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['id_guru'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="err-msg"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="alasan" class="pro-label">Alasan Izin</label>
                        <textarea class="pro-textarea <?php $__errorArgs = ['alasan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="alasan" name="alasan" rows="3" placeholder="Contoh: Lomba sekolah, Sakit, Urusan keluarga..." required><?php echo e(old('alasan')); ?></textarea>
                        <?php $__errorArgs = ['alasan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="err-msg"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <div class="mb-3">
                        <label for="waktu_keluar" class="pro-label">Waktu Keluar</label>
                        <input type="datetime-local" class="pro-input <?php $__errorArgs = ['waktu_keluar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="waktu_keluar" name="waktu_keluar" value="<?php echo e(old('waktu_keluar', now()->format('Y-m-d\TH:i'))); ?>" required>
                        <?php $__errorArgs = ['waktu_keluar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="err-msg"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <div class="alert alert-info py-2" style="font-size: 0.8rem; border-radius:10px">
                        <i class="fas fa-info-circle me-1"></i> Izin yang diajukan akan otomatis berstatus <strong>Keluar</strong>.
                    </div>
                    
                    <button type="submit" class="btn-prim w-100 justify-content-center py-2" style="font-size: 1rem">
                        <i class="fas fa-paper-plane"></i> Ajukan Izin Massal
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('siswaSearch');
    const kelasFilter = document.getElementById('kelasFilter');
    const jurusanFilter = document.getElementById('jurusanFilter');
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.siswa-checkbox');
    const selectedCount = document.getElementById('selectedCount');
    const rows = document.querySelectorAll('.siswa-row');

    function updateCount() {
        const checkedCount = document.querySelectorAll('.siswa-checkbox:checked').length;
        selectedCount.textContent = checkedCount + ' siswa dipilih';
    }

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const filterKelas = kelasFilter.value;
        const filterJurusan = jurusanFilter.value;

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const kelas = row.getAttribute('data-kelas');
            const matchesSearch = text.includes(searchTerm);
            const matchesKelas = filterKelas === '' || kelas.startsWith(filterKelas);
            const matchesJurusan = filterJurusan === '' || kelas.includes(filterJurusan);
            
            row.style.display = (matchesSearch && matchesKelas && matchesJurusan) ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTable);
    kelasFilter.addEventListener('change', filterTable);
    jurusanFilter.addEventListener('change', filterTable);

    selectAll.addEventListener('change', function() {
        checkboxes.forEach(cb => {
            if (cb.closest('tr').style.display !== 'none') {
                cb.checked = selectAll.checked;
            }
        });
        updateCount();
    });

    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateCount);
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\antigravity\website-sekolah-main\resources\views/izin-keluar/create.blade.php ENDPATH**/ ?>