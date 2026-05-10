<?php
// app/Http/Controllers/SiswaController.php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Siswa::latest();

        if ($request->filled('kelas')) {
            $query->where(function($q) use ($request) {
                $q->where('kelas', $request->kelas)
                  ->orWhere('kelas', 'like', $request->kelas . ' %');
            });
        }

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                  ->orWhere('nis', 'like', '%' . $request->search . '%');
            });
        }

        $siswa = $query->paginate(10)->withQueryString();
        
        $countX = Siswa::where('kelas', 'X')->orWhere('kelas', 'like', 'X %')->count();
        $countXI = Siswa::where('kelas', 'XI')->orWhere('kelas', 'like', 'XI %')->count();
        $countXII = Siswa::where('kelas', 'XII')->orWhere('kelas', 'like', 'XII %')->count();
        $totalSiswa = Siswa::count();

        return view('siswa.index', compact('siswa', 'countX', 'countXI', 'countXII', 'totalSiswa'));
    }

    public function create()
    {
        if (auth()->user()->role !== 'admin') {
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
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'nis' => 'required|unique:siswa,nis',
            'nama' => 'required|max:100',
            'kelas' => 'required|max:20'
        ]);

        $data = $request->all();
        $data['jurusan'] = '-';
        Siswa::create($data);

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }
        $request->validate([
            'nis' => 'required|unique:siswa,nis,' . $siswa->id_siswa . ',id_siswa',
            'nama' => 'required|max:100',
            'kelas' => 'required|max:20'
        ]);

        $data = $request->all();
        $data['jurusan'] = '-';
        $siswa->update($data);

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized access');
        }
        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

    public function laporan()
    {
        if (auth()->user()->role !== 'kepsek') {
            abort(403, 'Unauthorized access');
        }
        
        $siswa = Siswa::latest()->paginate(15);
        $totalSiswa = Siswa::count();
        $totalPerKelas = Siswa::selectRaw('kelas, COUNT(*) as total')
            ->groupBy('kelas')
            ->get();
        
        return view('laporan.siswa', compact('siswa', 'totalSiswa', 'totalPerKelas'));
    }
}
