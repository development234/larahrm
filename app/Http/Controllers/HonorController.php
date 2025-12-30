<?php

namespace App\Http\Controllers;

use App\Models\Honor;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HonorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        /*$honors = Honor::all();*/
        $honors = Honor::orderBy('created_at', 'desc')->paginate(10); // 10 item per page
        $karyawans = Karyawan::all();

        // Menghitung total karyawan yang lembur bulan ini
        $totalKaryawanLemburBulanIni = Honor::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->distinct('name_karyawan')
            ->count('name_karyawan');
            
        // Menghitung total jam lembur bulan ini
        $totalJamLemburBulanIni = Honor::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('total_jam');
            
        // Menghitung total pembayaran lembur bulan ini
        $totalPembayaranBulanIni = Honor::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->sum('total_pembayaran');
            
        // Statistik status honor bulan ini
        $statusHonorBulanIni = Honor::whereYear('created_at', now()->year)
            ->whereMonth('created_at', now()->month)
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();

        return view('honor.index', compact(
            'honors', 
            'karyawans',
            'totalKaryawanLemburBulanIni',
            'totalJamLemburBulanIni',
            'totalPembayaranBulanIni',
            'statusHonorBulanIni'
        ));

        /*return view('honor.index', compact('honors', 'karyawans'));*/
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = Karyawan::all();
        return view('honor.create', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_karyawan' => 'required|string|max:255',
            'rincian_lembur' => 'required|string',
            'total_jam' => 'required|integer|min:1',
            'total_pembayaran' => 'required|numeric|min:0',
            'status' => 'required|in:pending,dibayar,ditolak'
        ]);

        Honor::create($request->all());

        return redirect()->route('honor.index')
            ->with('success', 'Data honor berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Honor $honor)
    {
        return view('honor.show', compact('honor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Honor $honor)
    {
        $karyawans = Karyawan::all();
        return view('honor.edit', compact('honor', 'karyawans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Honor $honor)
    {
        $request->validate([
            'name_karyawan' => 'required|string|max:255',
            'rincian_lembur' => 'required|string',
            'total_jam' => 'required|integer|min:1',
            'total_pembayaran' => 'required|numeric|min:0',
            'status' => 'required|in:pending,dibayar,ditolak'
        ]);

        $honor->update($request->all());

        return redirect()->route('honor.index')
            ->with('success', 'Data honor berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Honor $honor)
    {
        $honor->delete();

        return redirect()->route('honor.index')
            ->with('success', 'Data honor berhasil dihapus.');
    }
}