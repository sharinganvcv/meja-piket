<?php
// app/Http/Controllers/SiswaController.php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Siswa::orderBy('nama', 'asc');

        // Filter by Tingkat (X, XI, XII)
        if ($request->filled('tingkat')) {
            $query->where(function($q) use ($request) {
                foreach ((array)$request->tingkat as $t) {
                    $q->orWhere('kelas', 'like', $t . ' %');
                }
            });
        }

        // Filter by Jurusan (PPLG, BCF, TO, TPFL)
        if ($request->filled('jurusan')) {
            $query->where(function($q) use ($request) {
                foreach ((array)$request->jurusan as $j) {
                    $q->orWhere('kelas', 'like', '% ' . $j . ' %')
                      ->orWhere('kelas', 'like', '% ' . $j);
                }
            });
        }

        // Filter by Kelas Detail (PPLG 1, PPLG 2, BCF 1, etc.)
        if ($request->filled('kelas_detail')) {
            $query->where(function($q) use ($request) {
                foreach ((array)$request->kelas_detail as $kd) {
                    $q->orWhere('kelas', 'like', '% ' . $kd);
                }
            });
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nis', 'like', '%' . $request->search . '%');
            });
        }

        $siswa = $query->get();
        
        $countX = Siswa::where('kelas', 'X')->orWhere('kelas', 'like', 'X %')->count();
        $countXI = Siswa::where('kelas', 'XI')->orWhere('kelas', 'like', 'XI %')->count();
        $countXII = Siswa::where('kelas', 'XII')->orWhere('kelas', 'like', 'XII %')->count();
        $totalSiswa = Siswa::count();

        return view('siswa.index', compact('siswa', 'countX', 'countXI', 'countXII', 'totalSiswa'));
    }

    public function create()
    {
        if (!in_array(auth()->user()->role, ['admin', 'guru'])) {
            abort(403, 'Unauthorized access');
        }
        return view('siswa.create');
    }

    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'guru'])) {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'nis' => 'required|unique:siswa,nis',
            'nama' => 'required|max:100',
            'kelas' => 'required|max:20',
            'jenis_kelamin' => 'nullable|in:L,P'
        ]);

        $data = $request->only(['nis', 'nama', 'kelas', 'jenis_kelamin']);
        $data['jurusan'] = '-';
        Siswa::create($data);

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        if (!in_array(auth()->user()->role, ['admin', 'guru'])) {
            abort(403, 'Unauthorized access');
        }
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        if (!in_array(auth()->user()->role, ['admin', 'guru'])) {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'nis' => 'required|unique:siswa,nis,' . $siswa->id_siswa . ',id_siswa',
            'nama' => 'required|max:100',
            'kelas' => 'required|max:20',
            'jenis_kelamin' => 'nullable|in:L,P'
        ]);

        $data = $request->only(['nis', 'nama', 'kelas', 'jenis_kelamin']);
        $data['jurusan'] = '-';
        $siswa->update($data);

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        if (!in_array(auth()->user()->role, ['admin', 'guru'])) {
            abort(403, 'Unauthorized access');
        }
        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:siswa,id_siswa'
        ]);

        $count = count($request->ids);
        Siswa::whereIn('id_siswa', $request->ids)->delete();

        return response()->json(['message' => "$count data siswa berhasil dihapus."]);
    }

    public function laporan()
    {
        if (!in_array(auth()->user()->role, ['admin', 'guru', 'kepsek'])) {
            abort(403, 'Unauthorized access');
        }
        
        $siswa = Siswa::latest()->paginate(15);
        $totalSiswa = Siswa::count();
        $totalPerKelas = Siswa::selectRaw('kelas, COUNT(*) as total')
            ->groupBy('kelas')
            ->get();
        
        return view('laporan.siswa', compact('siswa', 'totalSiswa', 'totalPerKelas'));
    }

    public function importCsv(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'guru'])) {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'file' => 'required|max:5120' // Max 5MB
        ]);

        $file = $request->file('file');
        $filePath = $file->getRealPath();
        
        // Detect delimiter
        $firstLine = fgets(fopen($filePath, 'r'));
        $delimiter = (str_contains($firstLine, ';')) ? ';' : ',';
        
        $handle = fopen($filePath, 'r');
        
        // Skip header
        $header = fgetcsv($handle, 1000, $delimiter);
        
        $count = 0;
        $errors = [];
        $row = 1;
        
        while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
            $row++;
            if (count($data) < 3) continue;
            
            $nis = trim($data[0]);
            $nama = trim($data[1]);
            $kelas = trim($data[2]);
            // Column 4 (index 3) = jenis kelamin (optional)
            $jk = isset($data[3]) ? strtoupper(trim($data[3])) : null;
            // Normalize: 'LAKI' => 'L', 'PEREMPUAN' => 'P'
            if ($jk === 'LAKI-LAKI' || $jk === 'LAKI') $jk = 'L';
            if ($jk === 'PEREMPUAN') $jk = 'P';
            if (!in_array($jk, ['L', 'P'])) $jk = null;
            
            if (empty($nis) || empty($nama) || empty($kelas)) {
                $errors[] = "Baris $row: Data tidak lengkap.";
                continue;
            }

            if (Siswa::where('nis', $nis)->exists()) {
                $errors[] = "Baris $row: NIS $nis ($nama) sudah ada.";
                continue;
            }
            
            try {
                $insertData = [
                    'nis'    => $nis,
                    'nama'   => $nama,
                    'kelas'  => $kelas,
                    'jurusan' => '-',
                ];
                // Only include jenis_kelamin if the column exists in DB
                if ($jk && \Illuminate\Support\Facades\Schema::hasColumn('siswa', 'jenis_kelamin')) {
                    $insertData['jenis_kelamin'] = $jk;
                }
                Siswa::create($insertData);
                $count++;
            } catch (\Exception $e) {
                $errors[] = "Baris $row: Gagal menyimpan (" . $e->getMessage() . ")";
            }
        }
        
        fclose($handle);
        
        if (count($errors) > 0) {
            $msg = "Berhasil mengimpor $count siswa. ";
            if (count($errors) > 5) {
                $msg .= "Ada " . count($errors) . " kesalahan data.";
            } else {
                $msg .= "Kesalahan: " . implode(', ', $errors);
            }
            return redirect()->route('siswa.index')->with('warning', $msg);
        }

        return redirect()->route('siswa.index')->with('success', "Berhasil mengimpor $count data siswa.");
    }
}
