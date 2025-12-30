<?php

namespace App\Http\Controllers;

use App\Models\Penggajian;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggajianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $karyawans = Karyawan::all();
        $penggajian = Penggajian::orderBy('created_at', 'desc')->paginate(10); // 10 item per page
        #$penggajian = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('penggajian.index', compact('penggajian', 'karyawans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil daftar karyawan dari tabel karyawan
        $karyawan = Karyawan::all();
        
        return view('penggajian.create', compact('karyawan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_user' => 'required|string|max:255',
            'periode' => 'required|date_format:Y-m',
            'status' => 'required|in:draft,diproses,selesai,dibatalkan',
            'tanggal_proses' => 'nullable|date',
            'total_dibayarkan' => 'required|numeric|min:0'
        ]);

        try {
            Penggajian::create($validated);
            
            return redirect()->route('penggajian.index')
                ->with('success', 'Data penggajian berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: '.$e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penggajian $penggajian)
    {
        $Penggajian = Penggajian::all();
        return view('penggajian.show', compact('penggajian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penggajian $penggajian)
    {
        // Ambil daftar karyawan dari tabel karyawan
        //$karyawan = DB::table('karyawan')->select('nama')->distinct()->get();
        $karyawan = Karyawan::all();
        return view('penggajian.edit', compact('penggajian', 'karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penggajian $penggajian)
    {
        $validated = $request->validate([
            'name_user' => 'required|string|max:255',
            'periode' => 'required|date_format:Y-m',
            'status' => 'required|in:draft,diproses,selesai,dibatalkan',
            'tanggal_proses' => 'nullable|date',
            'total_dibayarkan' => 'required|numeric|min:0'
        ]);

        try {
            $penggajian->update($validated);
            
            return redirect()->route('penggajian.index')
                ->with('success', 'Data penggajian berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: '.$e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penggajian $penggajian)
    {
        try {
            $penggajian->delete();
            
            return redirect()->route('penggajian.index')
                ->with('success', 'Data penggajian berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }
}