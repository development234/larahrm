<?php

namespace App\Http\Controllers;

use App\Models\Perizinan;
use App\Models\Karyawan; // Tambahkan ini
use Illuminate\Http\Request;

class PerizinanController extends Controller
{
    public function index()
    {
        $perizinan = Perizinan::with('karyawanRelation')->orderBy('created_at', 'desc')->get();
        
        return view('perizinan.index', compact('perizinan'));
    }

    public function create()
    {
        $karyawan = Karyawan::orderBy('name_user')->get(); // Ambil data karyawan
        return view('perizinan.create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:tb_karyawan,id', // Sesuaikan dengan nama tabel
            'jenis_izin' => 'required|string|max:255',
            'tanggal_izin' => 'required|date',
            'durasi' => 'required|string|max:255',
        ]);

        // Ambil data karyawan berdasarkan ID
        $karyawan = Karyawan::findOrFail($request->karyawan_id);

        Perizinan::create([
            'karyawan_id' => $request->karyawan_id,
            'karyawan' => $karyawan->name_user, // Sesuai dengan field di tb_karyawan
            'jabatan' => $karyawan->jabatan, // Sesuai dengan field di tb_karyawan
            'jenis_izin' => $request->jenis_izin,
            'tanggal_izin' => $request->tanggal_izin,
            'durasi' => $request->durasi,
            'status' => 'pending'
        ]);

        return redirect()->route('perizinan.index')
            ->with('success', 'Perizinan berhasil diajukan!');
    }

    public function edit(Perizinan $perizinan)
    {
        $karyawan = Karyawan::orderBy('name_user')->get(); // Tambahkan ini
        return view('perizinan.edit', compact('perizinan', 'karyawan')); // Kirim kedua variabel
    }

    public function update(Request $request, Perizinan $perizinan)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:tb_karyawan,id', // Sesuaikan dengan nama tabel
            'jenis_izin' => 'required|string|max:255',
            'tanggal_izin' => 'required|date',
            'durasi' => 'required|string|max:255',
            'status' => 'required|in:pending,disetujui,ditolak',
        ]);

        // Ambil data karyawan berdasarkan ID
        $karyawan = Karyawan::findOrFail($request->karyawan_id);

        $perizinan->update([
            'karyawan_id' => $request->karyawan_id,
            'karyawan' => $karyawan->name_user, // Sesuai dengan field di tb_karyawan
            'jabatan' => $karyawan->jabatan, // Sesuai dengan field di tb_karyawan
            'jenis_izin' => $request->jenis_izin,
            'tanggal_izin' => $request->tanggal_izin,
            'durasi' => $request->durasi,
            'status' => $request->status
        ]);

        return redirect()->route('perizinan.index')
            ->with('success', 'Perizinan berhasil diperbarui!');
    }

    public function destroy(Perizinan $perizinan)
    {
        $perizinan->delete();

        return redirect()->route('perizinan.index')
            ->with('success', 'Perizinan berhasil dihapus!');
    }
}