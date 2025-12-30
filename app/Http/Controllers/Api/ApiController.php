<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Karyawan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    // ==================== ABSENSI METHODS ====================
    
    public function getAbsensi(Request $request): JsonResponse
    {
        $absensi = Absen::with('karyawan')
            ->when($request->karyawan_id, function($query) use ($request) {
                return $query->where('karyawan_id', $request->karyawan_id);
            })
            ->when($request->tanggal, function($query) use ($request) {
                return $query->whereDate('tanggal', $request->tanggal);
            })
            ->when($request->status, function($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->orderBy('tanggal', 'desc')
            ->orderBy('jam_masuk', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $absensi
        ]);
    }

    public function createAbsensi(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:tb_karyawan,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i',
            'status' => 'required|in:Hadir,Izin,Sakit,Alpha'
        ]);

        // Get data karyawan
        $karyawan = Karyawan::findOrFail($validated['karyawan_id']);

        // Cek duplikasi absen
        $absenExist = Absen::where('karyawan_id', $validated['karyawan_id'])
                        ->whereDate('tanggal', $validated['tanggal'])
                        ->exists();

        if ($absenExist) {
            return response()->json([
                'success' => false,
                'message' => 'Data absensi untuk karyawan ini pada tanggal tersebut sudah ada!'
            ], 422);
        }

        // Create absensi
        $absen = Absen::create([
            'karyawan_id' => $validated['karyawan_id'],
            'nama' => $karyawan->name_user,
            'jabatan' => $karyawan->jabatan,
            'tanggal' => $validated['tanggal'],
            'jam_masuk' => $validated['jam_masuk'],
            'jam_keluar' => $validated['jam_keluar'],
            'status' => $validated['status']
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data absensi berhasil ditambahkan!',
            'data' => $absen
        ], 201);
    }

    public function getAbsensiById($id): JsonResponse
    {
        $absen = Absen::with('karyawan')->find($id);

        if (!$absen) {
            return response()->json([
                'success' => false,
                'message' => 'Data absensi tidak ditemukan!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $absen
        ]);
    }

    public function updateAbsensi(Request $request, $id): JsonResponse
    {
        $validated = $request->validate([
            'jam_masuk' => 'sometimes|required|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i',
            'status' => 'sometimes|required|in:Hadir,Izin,Sakit,Alpha'
        ]);

        $absen = Absen::find($id);

        if (!$absen) {
            return response()->json([
                'success' => false,
                'message' => 'Data absensi tidak ditemukan!'
            ], 404);
        }

        $absen->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data absensi berhasil diupdate!',
            'data' => $absen
        ]);
    }

    public function deleteAbsensi($id): JsonResponse
    {
        $absen = Absen::find($id);

        if (!$absen) {
            return response()->json([
                'success' => false,
                'message' => 'Data absensi tidak ditemukan!'
            ], 404);
        }

        $absen->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data absensi berhasil dihapus!'
        ]);
    }
    
    // ==================== KARYAWAN METHODS ====================
    
    /**
     * Get all karyawan
     */
    public function getKaryawan(): JsonResponse
    {
        try {
            $karyawan = Karyawan::all();
            
            return response()->json([
                'success' => true,
                'message' => 'Data karyawan berhasil diambil',
                'data' => $karyawan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data karyawan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get karyawan by ID
     */
    public function getKaryawanById($id): JsonResponse
    {
        try {
            $karyawan = Karyawan::find($id);

            if (!$karyawan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data karyawan tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Data karyawan berhasil diambil',
                'data' => $karyawan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data karyawan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Create new karyawan
     */
    public function createKaryawan(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name_user' => 'required|string|max:255',
                'nik' => 'required|string|unique:tb_karyawan,nik',
                'jabatan' => 'required|string|max:255',
                'tanggal_gabung' => 'required|date',
                'Status' => 'required|in:Aktif,Non-Aktif',
                'email' => 'nullable|email',
                'password' => 'required|string|min:6'
            ]);

            $karyawan = Karyawan::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data karyawan berhasil ditambahkan',
                'data' => $karyawan
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan data karyawan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update karyawan
     */
    public function updateKaryawan(Request $request, $id): JsonResponse
    {
        try {
            $karyawan = Karyawan::find($id);

            if (!$karyawan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data karyawan tidak ditemukan'
                ], 404);
            }

            $validated = $request->validate([
                'name_user' => 'sometimes|required|string|max:255',
                'nik' => 'sometimes|required|string|unique:tb_karyawan,nik,' . $id,
                'jabatan' => 'sometimes|required|string|max:255',
                'tanggal_gabung' => 'sometimes|required|date',
                'Status' => 'sometimes|required|in:Aktif,Non-Aktif',
                'email' => 'nullable|email',
                'password' => 'sometimes|required|string|min:6'
            ]);

            $karyawan->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Data karyawan berhasil diupdate',
                'data' => $karyawan
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate data karyawan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete karyawan
     */
    public function deleteKaryawan($id): JsonResponse
    {
        try {
            $karyawan = Karyawan::find($id);

            if (!$karyawan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data karyawan tidak ditemukan'
                ], 404);
            }

            // Cek apakah karyawan memiliki data absensi
            if ($karyawan->absensi()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat menghapus karyawan karena memiliki data absensi'
                ], 422);
            }

            $karyawan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data karyawan berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data karyawan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Login karyawan tanpa password
     */
    public function loginKaryawan(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'nik' => 'required|string'
                // Password dihapus dari validasi
            ]);
    
            $karyawan = Karyawan::where('nik', $validated['nik'])
                              ->where('Status', 'Aktif')
                              ->first();
    
            if (!$karyawan) {
                return response()->json([
                    'success' => false,
                    'message' => 'NIK tidak ditemukan atau akun tidak aktif'
                ], 401);
            }
    
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil',
                'data' => $karyawan
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal login: ' . $e->getMessage()
            ], 500);
        }
    }
}