<?php

namespace App\Http\Controllers;

use App\Models\Absen;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        // Mengambil data absensi dengan relasi karyawan
        $absensi = Absen::with('karyawan')
            ->orderBy('tanggal', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();
            
        // Mengambil data karyawan aktif untuk modal absen masuk
        $karyawan = Karyawan::where('Status', 'Aktif')->orderBy('name_user')->get();
        
        return view('absensi.index', compact('absensi', 'karyawan'));
    }

    public function create()
    {
        $karyawan = Karyawan::where('Status', 'Aktif')->orderBy('name_user')->get();
        return view('absensi.create', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:tb_karyawan,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpha'
        ]);

        // Get data karyawan
        $karyawan = Karyawan::findOrFail($request->karyawan_id);

        // Cek duplikasi absen untuk karyawan dan tanggal yang sama
        $absenExist = Absen::where('karyawan_id', $request->karyawan_id)
                        ->whereDate('tanggal', $request->tanggal)
                        ->exists();

        if ($absenExist) {
            return redirect()->back()->withInput()->with('error', 'Data absensi untuk karyawan ini pada tanggal tersebut sudah ada!');
        }

        Absen::create([
            'karyawan_id' => $request->karyawan_id,
            'nama' => $karyawan->name_user,
            'jabatan' => $karyawan->jabatan,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'status' => $request->status
        ]);

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $absen = Absen::with('karyawan')->findOrFail($id);
        $karyawan = Karyawan::where('Status', 'Aktif')->orderBy('name_user')->get();
        
        return view('absensi.edit', compact('absen', 'karyawan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:tb_karyawan,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpha'
        ]);

        $absen = Absen::findOrFail($id);
        
        // Get data karyawan
        $karyawan = Karyawan::findOrFail($request->karyawan_id);

        // Cek duplikasi absen untuk karyawan dan tanggal yang sama (kecuali data yang sedang diupdate)
        $absenExist = Absen::where('karyawan_id', $request->karyawan_id)
                        ->whereDate('tanggal', $request->tanggal)
                        ->where('id', '!=', $id)
                        ->exists();

        if ($absenExist) {
            return redirect()->back()->withInput()->with('error', 'Data absensi untuk karyawan ini pada tanggal tersebut sudah ada!');
        }

        $absen->update([
            'karyawan_id' => $request->karyawan_id,
            'nama' => $karyawan->name_user,
            'jabatan' => $karyawan->jabatan,
            'tanggal' => $request->tanggal,
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'status' => $request->status
        ]);

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $absen = Absen::findOrFail($id);
        $absen->delete();

        return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil dihapus!');
    }

    public function absenMasuk(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:tb_karyawan,id'
        ]);

        $karyawan = Karyawan::findOrFail($request->karyawan_id);

        // Cek apakah sudah absen hari ini
        $absenHariIni = Absen::where('karyawan_id', $request->karyawan_id)
                            ->whereDate('tanggal', now()->toDateString())
                            ->first();

        if ($absenHariIni) {
            return redirect()->back()->with('error', 'Karyawan sudah melakukan absen masuk hari ini!');
        }

        Absen::create([
            'karyawan_id' => $request->karyawan_id,
            'nama' => $karyawan->name_user,
            'jabatan' => $karyawan->jabatan,
            'jam_masuk' => now()->format('H:i'),
            'status' => 'Hadir',
            'tanggal' => now()->toDateString()
        ]);

        return redirect()->route('absensi.index')->with('success', 'Absen masuk berhasil!');
    }

    public function absenKeluar($id)
    {
        $absen = Absen::findOrFail($id);
        
        if ($absen->jam_keluar) {
            return redirect()->back()->with('error', 'Karyawan sudah melakukan absen keluar!');
        }

        $absen->update([
            'jam_keluar' => now()->format('H:i')
        ]);

        return redirect()->route('absensi.index')->with('success', 'Absen keluar berhasil!');
    }
}