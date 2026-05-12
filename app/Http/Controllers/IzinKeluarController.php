<?php
// app/Http/Controllers/IzinKeluarController.php

namespace App\Http\Controllers;

use App\Models\IzinKeluar;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;

class IzinKeluarController extends Controller
{
    public function index(Request $request)
    {
        $query = IzinKeluar::with(['siswa', 'guru'])->latest();

        // Join with siswa to filter by student's class
        $query->whereHas('siswa', function($q) use ($request) {
            // Filter by Tingkat (X, XI, XII)
            if ($request->filled('tingkat')) {
                $q->where(function($sq) use ($request) {
                    foreach ((array)$request->tingkat as $t) {
                        $sq->orWhere('kelas', 'like', $t . ' %');
                    }
                });
            }

            // Filter by Jurusan (PPLG, BCF, TO, TPFL)
            if ($request->filled('jurusan')) {
                $q->where(function($sq) use ($request) {
                    foreach ((array)$request->jurusan as $j) {
                        $sq->orWhere('kelas', 'like', '% ' . $j . ' %')
                          ->orWhere('kelas', 'like', '% ' . $j);
                    }
                });
            }

            // Filter by Kelas Detail (PPLG 1, etc.)
            if ($request->filled('kelas_detail')) {
                $q->where(function($sq) use ($request) {
                    foreach ((array)$request->kelas_detail as $kd) {
                        $sq->orWhere('kelas', 'like', '% ' . $kd);
                    }
                });
            }

            // Search by student name or NIS
            if ($request->filled('search')) {
                $q->where(function($sq) use ($request) {
                    $sq->where('nama', 'like', '%' . $request->search . '%')
                      ->orWhere('nis', 'like', '%' . $request->search . '%');
                });
            }
        });

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $izinKeluar = $query->get();
        return view('izin-keluar.index', compact('izinKeluar'));
    }

    public function create()
    {
        $siswa = Siswa::all();
        $guru = Guru::all();
        return view('izin-keluar.create', compact('siswa', 'guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required|array',
            'id_siswa.*' => 'exists:siswa,id_siswa',
            'id_guru' => 'required|exists:guru,id_guru',
            'alasan' => 'required',
            'waktu_keluar' => 'required|date'
        ]);

        $count = 0;
        foreach ($request->id_siswa as $idSiswa) {
            IzinKeluar::create([
                'id_siswa' => $idSiswa,
                'id_guru' => $request->id_guru,
                'alasan' => $request->alasan,
                'waktu_keluar' => $request->waktu_keluar,
                'status' => 'keluar'
            ]);
            $count++;
        }

        return redirect()->route('izin-keluar.index')
            ->with('success', "$count izin keluar berhasil diajukan sekaligus.");
    }

    public function edit(IzinKeluar $izinKeluar)
    {
        $siswa = Siswa::all();
        $guru = Guru::all();
        return view('izin-keluar.edit', compact('izinKeluar', 'siswa', 'guru'));
    }

    public function update(Request $request, IzinKeluar $izinKeluar)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,completed',
            'waktu_kembali' => 'nullable|date'
        ]);

        $izinKeluar->update($request->all());

        return redirect()->route('izin-keluar.index')
            ->with('success', 'Data izin keluar berhasil diperbarui.');
    }

    public function show(IzinKeluar $izinKeluar)
    {
        $izinKeluar->load(['siswa', 'guru']);
        return view('izin-keluar.show', compact('izinKeluar'));
    }

    public function destroy(IzinKeluar $izinKeluar)
    {
        $izinKeluar->delete();

        return redirect()->route('izin-keluar.index')
            ->with('success', 'Data izin keluar berhasil dihapus.');
    }

    public function laporan(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'guru', 'kepsek'])) {
            abort(403, 'Unauthorized access');
        }

        $bulan = $request->get('bulan', now()->month);
        $tahun = $request->get('tahun', now()->year);
        $status = $request->get('status', '');

        $query = IzinKeluar::with(['siswa', 'guru'])
            ->whereMonth('waktu_keluar', $bulan)
            ->whereYear('waktu_keluar', $tahun);

        if ($status) {
            $query->where('status', $status);
        }

        $izin = $query->orderBy('waktu_keluar')->get();

        $totalIzin = IzinKeluar::count();
        $izinBulanIni = $izin->count();
        $izinPerStatus = $izin->groupBy('status')->map->count();

        return view('laporan.izin', compact(
            'izin', 'totalIzin', 'izinBulanIni', 'izinPerStatus', 'bulan', 'tahun', 'status'
        ));
    }

    public function bulkReturn(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:izin_keluar,id_izin'
        ]);

        IzinKeluar::whereIn('id_izin', $request->ids)
            ->where('status', 'keluar')
            ->update([
                'status' => 'kembali',
                'waktu_kembali' => now()
            ]);

        return redirect()->route('izin-keluar.index')
            ->with('success', count($request->ids) . ' siswa berhasil dikonfirmasi kembali.');
    }
}
