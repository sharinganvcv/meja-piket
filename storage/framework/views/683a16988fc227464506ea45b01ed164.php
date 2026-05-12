<?php $__env->startSection('content'); ?>
<?php echo $__env->make('components.page-styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="pg-wrap">
    
    <div class="pg-header no-print">
        <div class="pg-title">
            <div class="icon" style="background:linear-gradient(135deg,#6366f1,#a855f7)"><i class="fas fa-file-alt"></i></div>
            <div><h1>Laporan Izin Keluar</h1><p>Rekapitulasi data izin keluar siswa</p></div>
        </div>
        <div class="pg-actions">
            <button onclick="window.print()" class="btn-prim">
                <i class="fas fa-print"></i> Cetak / Simpan PDF
            </button>
        </div>
    </div>

    
    <form method="GET" action="<?php echo e(route('laporan.izin')); ?>" class="filter-card mb-4 no-print">
        <div class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="filter-label">Bulan</label>
                <select name="bulan" class="pro-select" style="width:100%; padding:.6rem; border-radius:10px; border:2px solid #e8ecf4">
                    <?php $__currentLoopData = range(1,12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($m); ?>" <?php echo e($bulan == $m ? 'selected' : ''); ?>>
                        <?php echo e(\Carbon\Carbon::create()->month($m)->translatedFormat('F')); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="filter-label">Tahun</label>
                <select name="tahun" class="pro-select" style="width:100%; padding:.6rem; border-radius:10px; border:2px solid #e8ecf4">
                    <?php $__currentLoopData = range(now()->year - 2, now()->year + 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($y); ?>" <?php echo e($tahun == $y ? 'selected' : ''); ?>><?php echo e($y); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="filter-label">Status</label>
                <select name="status" class="pro-select" style="width:100%; padding:.6rem; border-radius:10px; border:2px solid #e8ecf4">
                    <option value="">Semua Status</option>
                    <option value="keluar" <?php echo e($status == 'keluar' ? 'selected' : ''); ?>>Keluar</option>
                    <option value="kembali" <?php echo e($status == 'kembali' ? 'selected' : ''); ?>>Kembali</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn-prim w-100 justify-content-center" style="padding:.6rem">
                    <i class="fas fa-search"></i> Tampilkan
                </button>
            </div>
        </div>
    </form>

    
    <div class="mini-stats no-print">
        <div class="ms-card"><div class="ms-icon i"><i class="fas fa-door-open"></i></div><div><div class="ms-val"><?php echo e($izinBulanIni); ?></div><div class="ms-lbl">Total Bulan Ini</div></div></div>
        <div class="ms-card"><div class="ms-icon s"><i class="fas fa-check-circle"></i></div><div><div class="ms-val"><?php echo e($izinPerStatus->get('kembali', 0)); ?></div><div class="ms-lbl">Sudah Kembali</div></div></div>
        <div class="ms-card"><div class="ms-icon w"><i class="fas fa-spinner"></i></div><div><div class="ms-val"><?php echo e($izinPerStatus->get('keluar', 0)); ?></div><div class="ms-lbl">Belum Kembali</div></div></div>
        <div class="ms-card"><div class="ms-icon p"><i class="fas fa-calendar"></i></div><div><div class="ms-val"><?php echo e($totalIzin); ?></div><div class="ms-lbl">Total Semua Waktu</div></div></div>
    </div>

    
    <div class="tbl-card print-doc">
        
        <div class="print-header">
            <img src="https://i.ibb.co/5b1d6f8/logo.png" alt="Logo" onerror="this.style.display='none'" style="height:70px">
            <div class="print-header-text">
                <div class="sekolah-nama">SMKN 1 CIOMAS</div>
                <div class="sekolah-sub">Sekolah Menengah Kejuruan Negeri 1 Ciomas</div>
                <div class="sekolah-alamat">Jl. Raya Ciomas, Bogor, Jawa Barat</div>
            </div>
        </div>
        <hr style="border:2px solid #2d3748; margin:0 0 8px">
        <div style="border-bottom:1px solid #2d3748; margin-bottom:16px"></div>

        
        <div style="text-align:center; margin-bottom:20px">
            <div style="font-size:1rem; font-weight:700; text-transform:uppercase; letter-spacing:1px">LAPORAN IZIN KELUAR SISWA</div>
            <div style="font-size:.85rem; color:#4a5568; margin-top:4px">
                Periode: <?php echo e(\Carbon\Carbon::create()->month($bulan)->translatedFormat('F')); ?> <?php echo e($tahun); ?>

                <?php if($status): ?> — Status: <?php echo e(ucfirst($status)); ?> <?php endif; ?>
            </div>
        </div>

        
        <table class="print-table">
            <thead>
                <tr>
                    <th style="width:35px">No</th>
                    <th>Nama Siswa</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Alasan</th>
                    <th>Guru Pemberi Izin</th>
                    <th>Waktu Keluar</th>
                    <th>Waktu Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $izin; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $iz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td style="text-align:center"><?php echo e($i + 1); ?></td>
                <td><strong><?php echo e($iz->siswa->nama ?? '-'); ?></strong></td>
                <td><?php echo e($iz->siswa->nis ?? '-'); ?></td>
                <td><?php echo e($iz->siswa->kelas ?? '-'); ?></td>
                <td><?php echo e($iz->alasan); ?></td>
                <td><?php echo e($iz->guru->nama ?? '-'); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($iz->waktu_keluar)->format('d/m/Y H:i')); ?></td>
                <td><?php echo e($iz->waktu_kembali ? \Carbon\Carbon::parse($iz->waktu_kembali)->format('d/m/Y H:i') : '-'); ?></td>
                <td style="text-align:center">
                    <span class="print-badge <?php echo e($iz->status === 'kembali' ? 'badge-kembali' : 'badge-keluar'); ?>">
                        <?php echo e(ucfirst($iz->status)); ?>

                    </span>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="9" style="text-align:center;padding:20px;color:#718096">Tidak ada data izin keluar untuk periode ini.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>

        
        <div style="margin-top:16px; display:flex; gap:24px; font-size:.82rem">
            <div><strong>Total Data:</strong> <?php echo e($izin->count()); ?> izin</div>
            <div><strong>Sudah Kembali:</strong> <?php echo e($izinPerStatus->get('kembali', 0)); ?></div>
            <div><strong>Belum Kembali:</strong> <?php echo e($izinPerStatus->get('keluar', 0)); ?></div>
        </div>

        
        <div class="ttd-box">
            <div class="ttd-item">
                <div>Mengetahui,</div>
                <div style="font-weight:600">Kepala Sekolah</div>
                <div class="ttd-space"></div>
                <div>( _________________________ )</div>
            </div>
            <div class="ttd-item">
                <div>Ciomas, <?php echo e(\Carbon\Carbon::now()->translatedFormat('d F Y')); ?></div>
                <div style="font-weight:600">Petugas / Guru Piket</div>
                <div class="ttd-space"></div>
                <div>( _________________________ )</div>
            </div>
        </div>
    </div>
</div>

<style>
/* --- SCREEN STYLES --- */
.print-doc { padding: 1.5rem; }
.print-header { display:flex; align-items:center; gap:16px; padding-bottom:12px; }
.print-header-text { flex:1; }
.sekolah-nama { font-size:1.35rem; font-weight:800; color:#1a202c; letter-spacing:.5px; }
.sekolah-sub { font-size:.9rem; color:#4a5568; font-weight:600; }
.sekolah-alamat { font-size:.8rem; color:#718096; }

.print-table { width:100%; border-collapse:collapse; font-size:.78rem; margin-top:8px; }
.print-table th { background:#2d3748; color:#fff; padding:8px 10px; text-align:left; font-weight:600; font-size:.75rem; }
.print-table td { padding:7px 10px; border-bottom:1px solid #e2e8f0; vertical-align:top; }
.print-table tbody tr:nth-child(even) { background:#f8fafc; }
.print-table tbody tr:hover { background:#eef2ff; }

.print-badge { display:inline-block; padding:2px 8px; border-radius:20px; font-size:.72rem; font-weight:700; }
.badge-kembali { background:#d1fae5; color:#065f46; }
.badge-keluar { background:#fef3c7; color:#92400e; }

.ttd-box { display:flex; justify-content:space-between; margin-top:40px; }
.ttd-item { text-align:center; font-size:.82rem; }
.ttd-space { height:60px; }

/* --- PRINT STYLES --- */
@media print {
    .no-print, .sidebar, .navbar, .pg-header, .mini-stats, .filter-card,
    .topbar, nav, header, footer { display: none !important; }

    body, html { margin:0; padding:0; font-family: Arial, sans-serif; font-size: 11pt; }
    .main-content { margin-left: 0 !important; padding: 0 !important; }
    .pg-wrap { padding: 0 !important; }

    .print-doc {
        box-shadow: none !important;
        border: none !important;
        padding: 10mm 15mm !important;
        margin: 0 !important;
    }

    .sekolah-nama { font-size: 16pt !important; }
    .sekolah-sub { font-size: 11pt !important; }

    .print-table { font-size: 9pt !important; }
    .print-table th { background: #2d3748 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    .print-table tbody tr:nth-child(even) { background: #f8fafc !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }

    .print-badge { border: 1px solid #999 !important; }
    .badge-kembali { background: #d1fae5 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    .badge-keluar { background: #fef3c7 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }

    @page { size: A4 landscape; margin: 15mm; }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\antigravity\website-sekolah-main\resources\views/laporan/izin.blade.php ENDPATH**/ ?>