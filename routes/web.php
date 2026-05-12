<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PiketController;
use App\Http\Controllers\IzinKeluarController;
use App\Http\Controllers\KeterlambatanController;
use App\Http\Controllers\PelanggaranController;
use App\Http\Controllers\JadwalPiketController;
use App\Http\Controllers\QRScannerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Selalu tampilkan halaman home, biarkan user memilih untuk login atau melihat fitur
    return view('home');
});

// Simple test routes
Route::get('/simple-test', function() {
    return 'Simple test works!';
});

Route::get('/session-check', function() {
    return session()->has('user')
        ? 'Session exists: ' . session('user')['name']
        : 'No session found';
});

Route::get('/auth-check', function() {
    return auth()->check()
        ? 'Authenticated as: ' . auth()->user()->name . ' (Role: ' . auth()->user()->role . ')'
        : 'Not authenticated';
});

Route::get('/siswa-test', function() {
    return view('siswa.create');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/test-route', fn() => 'Route test successful')->name('test.route');
    Route::get('/middleware-test', fn() => 'Middleware test successful')->middleware('role:admin');
    Route::get('/middleware-siswa', [SiswaController::class, 'create'])->middleware('role:admin');

    // Run pending migrations via browser (admin only)
    Route::get('/run-migrate', function () {
        if (auth()->user()->role !== 'admin') abort(403);
        $results = [];

        // Check if column already exists
        $hasColumn = \Illuminate\Support\Facades\Schema::hasColumn('siswa', 'jenis_kelamin');
        if ($hasColumn) {
            $results[] = ['status' => 'info', 'msg' => 'Kolom jenis_kelamin sudah ada di database.'];
        } else {
            // Try artisan migrate first
            try {
                \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
                $output = \Illuminate\Support\Facades\Artisan::output();
                $results[] = ['status' => 'ok', 'msg' => 'Migration artisan berhasil: ' . trim($output)];
            } catch (\Exception $e) {
                $results[] = ['status' => 'warn', 'msg' => 'Artisan gagal: ' . $e->getMessage() . '. Mencoba SQL langsung...'];
            }

            // If column still doesn't exist, run SQL directly
            if (!\Illuminate\Support\Facades\Schema::hasColumn('siswa', 'jenis_kelamin')) {
                try {
                    \Illuminate\Support\Facades\DB::statement("ALTER TABLE siswa ADD COLUMN jenis_kelamin ENUM('L','P') NULL AFTER kelas");
                    $results[] = ['status' => 'ok', 'msg' => 'Kolom jenis_kelamin berhasil ditambahkan via SQL langsung.'];
                } catch (\Exception $e) {
                    $results[] = ['status' => 'err', 'msg' => 'SQL gagal: ' . $e->getMessage()];
                }
            }
        }

        // Final check
        $hasColumn = \Illuminate\Support\Facades\Schema::hasColumn('siswa', 'jenis_kelamin');
        $results[] = ['status' => $hasColumn ? 'ok' : 'err', 'msg' => $hasColumn
            ? '✅ Kolom jenis_kelamin AKTIF. Sekarang Anda bisa import CSV dengan jenis kelamin.'
            : '❌ Kolom jenis_kelamin masih belum ada. Hubungi administrator.'];

        $html = '<div style="font-family:monospace;padding:30px;background:#0f172a;min-height:100vh">';
        $html .= '<h2 style="color:#f8fafc;margin-bottom:20px">🔧 Database Migration Status</h2>';
        foreach ($results as $r) {
            $color = $r['status'] === 'ok' ? '#4ade80' : ($r['status'] === 'err' ? '#f87171' : ($r['status'] === 'warn' ? '#fb923c' : '#60a5fa'));
            $html .= '<div style="color:' . $color . ';margin-bottom:12px;font-size:14px">» ' . htmlspecialchars($r['msg']) . '</div>';
        }
        $html .= '<div style="margin-top:30px"><a href="/siswa" style="color:#818cf8;text-decoration:none;font-size:14px">← Kembali ke Data Siswa</a></div>';
        $html .= '</div>';
        return $html;
    })->middleware('role:admin');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Test dashboard data
    Route::get('/test-dashboard', function() {
        try {
            $totalSiswa = \App\Models\Siswa::count();
            $totalGuru = \App\Models\Guru::count();
            $totalPiket = \App\Models\Piket::count();
            $totalKeterlambatan = \App\Models\Keterlambatan::count();
            $totalPelanggaran = \App\Models\Pelanggaran::count();
            $totalIzin = \App\Models\IzinKeluar::count();
            
            return "Dashboard data test successful: Siswa: $totalSiswa, Guru: $totalGuru, Piket: $totalPiket, Keterlambatan: $totalKeterlambatan, Pelanggaran: $totalPelanggaran, Izin: $totalIzin";
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    });

    // ================= SISWA =================
    Route::get('siswa/create', [SiswaController::class, 'create'])->middleware('role:admin,guru')->name('siswa.create');
    Route::post('siswa', [SiswaController::class, 'store'])->middleware('role:admin,guru')->name('siswa.store');
    Route::resource('siswa', SiswaController::class)->except(['create', 'store', 'edit', 'update', 'destroy'])->middleware('role:admin,guru');
    Route::get('siswa/{siswa}/edit', [SiswaController::class, 'edit'])->middleware('role:admin,guru')->name('siswa.edit');
    Route::put('siswa/{siswa}', [SiswaController::class, 'update'])->middleware('role:admin,guru')->name('siswa.update');
    Route::post('siswa/import', [SiswaController::class, 'importCsv'])->middleware('role:admin,guru')->name('siswa.import');
    Route::match(['POST','DELETE'], 'bulk-delete-siswa', [SiswaController::class, 'bulkDelete'])->middleware('role:admin')->name('siswa.bulk-delete');
    Route::delete('siswa/{siswa}', [SiswaController::class, 'destroy'])->middleware('role:admin,guru')->name('siswa.destroy');

    // ================= GURU =================
    Route::get('guru/create', [GuruController::class, 'create'])->middleware('role:admin,guru')->name('guru.create');
    Route::post('guru', [GuruController::class, 'store'])->middleware('role:admin,guru')->name('guru.store');
    Route::resource('guru', GuruController::class)->except(['create', 'store', 'edit', 'update', 'destroy'])->middleware('role:admin,guru');
    Route::get('guru/{guru}/edit', [GuruController::class, 'edit'])->middleware('role:admin,guru')->name('guru.edit');
    Route::put('guru/{guru}', [GuruController::class, 'update'])->middleware('role:admin,guru')->name('guru.update');
    Route::delete('guru/{guru}', [GuruController::class, 'destroy'])->middleware('role:admin,guru')->name('guru.destroy');

    // ================= PIKET =================
    Route::get('piket/create', [PiketController::class, 'create'])->middleware('role:admin,guru')->name('piket.create');
    Route::post('piket', [PiketController::class, 'store'])->middleware('role:admin,guru')->name('piket.store');
    Route::resource('piket', PiketController::class)->except(['create', 'store', 'edit', 'update', 'destroy'])->middleware('role:admin,guru');
    Route::get('piket/{piket}/edit', [PiketController::class, 'edit'])->middleware('role:admin,guru')->name('piket.edit');
    Route::put('piket/{piket}', [PiketController::class, 'update'])->middleware('role:admin,guru')->name('piket.update');
    Route::delete('piket/{piket}', [PiketController::class, 'destroy'])->middleware('role:admin,guru')->name('piket.destroy');

    // ================= IZIN KELUAR =================
    Route::get('izin-keluar/create', [IzinKeluarController::class, 'create'])->middleware('role:admin,guru')->name('izin-keluar.create');
    Route::match(['GET','POST','PUT','PATCH','DELETE'], 'bulk-return-izin', [IzinKeluarController::class, 'bulkReturn'])->middleware('role:admin,guru')->name('izin-keluar.bulk-return');
    Route::post('izin-keluar', [IzinKeluarController::class, 'store'])->middleware('role:admin,guru')->name('izin-keluar.store');
    Route::resource('izin-keluar', IzinKeluarController::class)->except(['create', 'store', 'edit', 'update', 'destroy'])->middleware('role:admin,guru');
    Route::get('izin-keluar/{izinKeluar}/edit', [IzinKeluarController::class, 'edit'])->middleware('role:admin,guru')->name('izin-keluar.edit');
    Route::put('izin-keluar/{izinKeluar}', [IzinKeluarController::class, 'update'])->middleware('role:admin,guru')->name('izin-keluar.update');
    Route::delete('izin-keluar/{izinKeluar}', [IzinKeluarController::class, 'destroy'])->middleware('role:admin,guru')->name('izin-keluar.destroy');

    // ================= KETERLAMBATAN =================
    Route::get('keterlambatan/create', [KeterlambatanController::class, 'create'])->middleware('role:admin,guru')->name('keterlambatan.create');
    Route::post('keterlambatan', [KeterlambatanController::class, 'store'])->middleware('role:admin,guru')->name('keterlambatan.store');
    Route::resource('keterlambatan', KeterlambatanController::class)->except(['create', 'store', 'edit', 'update', 'destroy'])->middleware('role:admin,guru');
    Route::get('keterlambatan/{keterlambatan}/edit', [KeterlambatanController::class, 'edit'])->middleware('role:admin,guru')->name('keterlambatan.edit');
    Route::put('keterlambatan/{keterlambatan}', [KeterlambatanController::class, 'update'])->middleware('role:admin,guru')->name('keterlambatan.update');
    Route::delete('keterlambatan/{keterlambatan}', [KeterlambatanController::class, 'destroy'])->middleware('role:admin,guru')->name('keterlambatan.destroy');

    // ================= PELANGGARAN =================
    Route::get('pelanggaran/create', [PelanggaranController::class, 'create'])->middleware('role:admin,guru')->name('pelanggaran.create');
    Route::post('pelanggaran', [PelanggaranController::class, 'store'])->middleware('role:admin,guru')->name('pelanggaran.store');
    Route::get('pelanggaran/rekap', [PelanggaranController::class, 'rekap'])->middleware('role:admin,guru')->name('pelanggaran.rekap');
    Route::resource('pelanggaran', PelanggaranController::class)->except(['create', 'store', 'edit', 'update', 'destroy'])->middleware('role:admin,guru');
    Route::get('pelanggaran/{pelanggaran}/edit', [PelanggaranController::class, 'edit'])->middleware('role:admin,guru')->name('pelanggaran.edit');
    Route::put('pelanggaran/{pelanggaran}', [PelanggaranController::class, 'update'])->middleware('role:admin,guru')->name('pelanggaran.update');
    Route::delete('pelanggaran/{pelanggaran}', [PelanggaranController::class, 'destroy'])->middleware('role:admin,guru')->name('pelanggaran.destroy');

    // ================= JADWAL PIKET =================
    Route::get('jadwal-piket/create', [JadwalPiketController::class, 'create'])->middleware('role:admin,guru')->name('jadwal-piket.create');
    Route::post('jadwal-piket', [JadwalPiketController::class, 'store'])->middleware('role:admin,guru')->name('jadwal-piket.store');
    Route::get('jadwal-piket/hari-ini', [JadwalPiketController::class, 'getJadwalHariIni'])->name('jadwal-piket.hari-ini');
    Route::resource('jadwal-piket', JadwalPiketController::class)->except(['create', 'store', 'edit', 'update', 'destroy'])->middleware('role:admin,guru');
    Route::get('jadwal-piket/{jadwalPiket}/edit', [JadwalPiketController::class, 'edit'])->middleware('role:admin,guru')->name('jadwal-piket.edit');
    Route::put('jadwal-piket/{jadwalPiket}', [JadwalPiketController::class, 'update'])->middleware('role:admin,guru')->name('jadwal-piket.update');
    Route::delete('jadwal-piket/{jadwalPiket}', [JadwalPiketController::class, 'destroy'])->middleware('role:admin,guru')->name('jadwal-piket.destroy');

    // ================= QR =================
    Route::post('/api/qr-scan', [QRScannerController::class, 'scan'])->middleware('role:admin,guru')->name('qr.scan');
    Route::get('/api/qr-generate/{siswa}', [QRScannerController::class, 'generateQr'])->middleware('role:admin,guru')->name('qr.generate');

    // ================= LAPORAN (ADMIN, GURU & KEPALA SEKOLAH) =================
    Route::get('laporan/siswa', [SiswaController::class, 'laporan'])->middleware('role:admin,guru,kepsek')->name('laporan.siswa');
    Route::get('laporan/guru', [GuruController::class, 'laporan'])->middleware('role:admin,guru,kepsek')->name('laporan.guru');
    Route::get('laporan/piket', [PiketController::class, 'laporan'])->middleware('role:admin,guru,kepsek')->name('laporan.piket');
    Route::get('laporan/izin', [IzinKeluarController::class, 'laporan'])->middleware('role:admin,guru,kepsek')->name('laporan.izin');
    Route::get('laporan/keterlambatan', [KeterlambatanController::class, 'laporan'])->middleware('role:admin,guru,kepsek')->name('laporan.keterlambatan');
    Route::get('laporan/pelanggaran', [PelanggaranController::class, 'laporan'])->middleware('role:admin,guru,kepsek')->name('laporan.pelanggaran');

    // ================= DEBUG ROUTE =================
    Route::get('/cek-db', function() {
        try {
            $dbName = DB::connection()->getDatabaseName();
            $siswaCount = \App\Models\Siswa::count();
            $guruCount = \App\Models\Guru::count();
            $latestSiswa = \App\Models\Siswa::latest()->take(3)->get();
            
            return response()->json([
                'database_name' => $dbName,
                'total_siswa' => $siswaCount,
                'total_guru' => $guruCount,
                'latest_siswa_added' => $latestSiswa,
                'status' => 'Connection OK'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    });

});

// ================= AUTH =================
// Note: Login routes are handled in auth.php


// logout fallback
Route::get('logout', function() {
    return redirect()->route('login')->with('message', 'Please use the logout button.');
})->name('logout.get');

// profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';