<?php

namespace App\Http\Controllers;

use App\Models\Honor;
use App\Models\User;
use App\Models\Absen;
use App\Models\Penggajian;
use App\Models\Karyawan;
use App\Models\Perizinan;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Data dasar
            $totalUsers = User::count();
            $totalArea = Area::count();
            $totalSemuaKaryawan = Karyawan::count();
            //izin Total
            $totalizin = Perizinan::count();
            //absensi
            $absensi = Absen::count();
            //Gajian
            $gaji = Penggajian::count();

            // Inisialisasi variabel honor
            $totalKaryawanLemburBulanIni = 0;
            $totalJamLemburBulanIni = 0;
            $totalPembayaranBulanIni = 0;
            $statusHonorBulanIni = collect();
            $honors = collect();

            // Data untuk honor
            if (class_exists('App\Models\Honor')) {
                try {
                    $honorBulanIni = Honor::whereYear('created_at', now()->year)
                                        ->whereMonth('created_at', now()->month)
                                        ->get();

                    if ($honorBulanIni->count() > 0) {
                        $totalKaryawanLemburBulanIni = $honorBulanIni->unique('karyawan_id')->count();
                        $totalJamLemburBulanIni = $honorBulanIni->sum('total_jam');
                        $totalPembayaranBulanIni = $honorBulanIni->sum('total_pembayaran');
                        
                        $statusHonorBulanIni = $honorBulanIni->groupBy('status')->map(function ($group, $status) {
                            return [
                                'status' => $status,
                                'total' => $group->count()
                            ];
                        });
                    }

                    $honors = Honor::with('karyawan')
                                  ->latest()
                                  ->take(5)
                                  ->get();

                } catch (\Exception $e) {
                    \Log::error('Error processing honor data: ' . $e->getMessage());
                }
            }

            // Data untuk grafik karyawan per bulan (12 bulan terakhir)
            $karyawanPerBulan = Karyawan::select(
                    DB::raw('YEAR(created_at) as year'),
                    DB::raw('MONTH(created_at) as month'),
                    DB::raw('COUNT(*) as total')
                )
                ->where('created_at', '>=', now()->subMonths(12))
                ->groupBy('year', 'month')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->get()
                ->map(function ($item) {
                    return [
                        'bulan' => date('M Y', mktime(0, 0, 0, $item->month, 1, $item->year)),
                        'total' => $item->total
                    ];
                })
                ->reverse()
                ->values();

            // Data untuk grafik honor per bulan
            $honorPerBulan = collect();
            if (class_exists('App\Models\Honor')) {
                $honorPerBulan = Honor::select(
                        DB::raw('YEAR(created_at) as year'),
                        DB::raw('MONTH(created_at) as month'),
                        DB::raw('COUNT(*) as total')
                    )
                    ->where('created_at', '>=', now()->subMonths(6))
                    ->groupBy('year', 'month')
                    ->orderBy('year', 'desc')
                    ->orderBy('month', 'desc')
                    ->get()
                    ->map(function ($item) {
                        return [
                            'bulan' => date('M Y', mktime(0, 0, 0, $item->month, 1, $item->year)),
                            'total' => $item->total
                        ];
                    })
                    ->reverse()
                    ->values();
            }

            return view('dashboard', compact(
                'totalUsers',
                'totalArea',
                'totalSemuaKaryawan',
                'honors', 
                'totalKaryawanLemburBulanIni', 
                'totalJamLemburBulanIni', 
                'totalPembayaranBulanIni', 
                'statusHonorBulanIni',
                'karyawanPerBulan',
                'honorPerBulan',
                'totalizin',
                'absensi',
                'gaji'
            ));

        } catch (\Exception $e) {
            \Log::error('Dashboard controller error: ' . $e->getMessage());
            
            return view('dashboard', [
                'totalUsers' => 0,
                'totalSemuaKaryawan' => 0,
                'honors' => collect(),
                'totalKaryawanLemburBulanIni' => 0,
                'totalJamLemburBulanIni' => 0,
                'totalPembayaranBulanIni' => 0,
                'statusHonorBulanIni' => collect(),
                'karyawanPerBulan' => collect(),
                'honorPerBulan' => collect(),
                'totalizin' =>collect(),
                'absensi' =>collect(),
                'gaji' =>collect(),
            ]);
        }
    }
}