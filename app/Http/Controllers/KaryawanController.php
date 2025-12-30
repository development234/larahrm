<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\Rekening;
use App\Models\User;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    
    /**
    * Display a listing of the resource.
    */
    public function index(Request $request)
    {
        try {
            // Base query
            $query = Karyawan::orderByDesc('created_at');
    
           // 🔎 Search multi kolom
            if ($request->filled('search')) {
                $search = $request->search;
    
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', "%{$search}%")
                      ->orWhere('nik', 'like', "%{$search}%")
                      ->orWhere('jabatan', 'like', "%{$search}%");
                });
            }
            
            // Pagination + keep query string
            $karyawan = $query->paginate(10)->withQueryString();
    
            // Total karyawan aktif
            $totalAktif = Karyawan::where('Status', 'Aktif')->count();
    
            return view('karyawan.index', compact('karyawan', 'totalAktif'));
    
        } catch (\Exception $e) {
            return view('karyawan.index', [
                    'karyawan' => collect(),
                    'totalAktif' => 0
                ])
                ->with('error', 'Gagal memuat data karyawan: '.$e->getMessage());
        }
    }

    
    public function create()
    {
        try {
            // Ambil semua data users
            $users = User::all();
            $jabatan = Jabatan::orderBy('jabatan')->get();
            $rekening = Rekening::orderBy('bank')->get();
            $areas = Area::orderBy('nama_area')->get();
            return view('karyawan.create', compact('users', 'jabatan','rekening','areas'));

        } catch (\Exception $e) {
            return redirect()->route('karyawan.index')
                ->with('error', 'Gagal memuat form: ' . $e->getMessage());
        }
    }
     /**
     * Menyimpan data karyawan baru
     */
    public function store(Request $request)
    {
        try {
    
            /* VALIDASI INPUT UTAMA (yang diketik user) */
            $validated = $request->validate([
                'nama_lengkap'    => 'required|string|max:255',
                'email'           => 'nullable|email|max:255',
                'hp'              => 'nullable|numeric',
                'tempat_lahir'    => 'nullable|string|max:100',
                'tgl_lahir'       => 'nullable|date',
                'alamat'          => 'nullable|string',
                'area_kerja'      => 'nullable|string|max:100',
                'jabatan'         => 'required|string|max:100',
                'tanggal_gabung'  => 'required|date',
                'akhir_kontrak'   => 'nullable|date',
                'rekening'        => 'nullable|string|max:100',
                'Status'          => 'required|in:Aktif,Non-Aktif',
    
                'berkas1' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'berkas2' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'berkas3' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);
    
            DB::beginTransaction();
    
            /* DAPATKAN ID BERIKUTNYA (sebagai referensi format) */
            $nextId = (Karyawan::max('id') ?? 0) + 1;
    
            /* FORMAT ID PERSONEL */
            $nama4 = Str::upper(Str::substr($validated['nama_lengkap'], 0, 4));
            $tglJoin = date('Ymd', strtotime($validated['tanggal_gabung']));
            $validated['id_personel'] = $nextId.$nama4.$tglJoin;
    
            /* FORMAT NIK */
            $nik = 'PER'.$nextId.date('dm', strtotime($validated['tanggal_gabung'])).date('Y', strtotime($validated['tanggal_gabung']));
            $validated['nik'] = $nik;
    
            /* USERNAME = NIK */
            $validated['name_user'] = $nik;
    
            /* PASSWORD DEFAULT */
            $validated['password'] = Hash::make('123456789');
    
            /* UPLOAD FILE */
            foreach (['berkas1','berkas2','berkas3'] as $file) {
                if ($request->hasFile($file)) {
                    $validated[$file] = $request->file($file)
                        ->store('karyawan/berkas', 'public');
                }
            }
    
            /* SIMPAN */
            Karyawan::create($validated);
    
            DB::commit();
    
            return redirect()
                ->route('karyawan.index')
                ->with('success','Karyawan berhasil ditambahkan');
    
        } catch (\Illuminate\Validation\ValidationException $e) {
    
            DB::rollBack();
            return back()->withErrors($e->validator)->withInput();
    
        } catch (\Exception $e) {
    
            DB::rollBack();
            return back()
                ->with('error','Gagal menyimpan data: '.$e->getMessage())
                ->withInput();
        }
    }

    
    /**
     * Menampilkan detail karyawan
     */
    public function show($id)
    {
        try {
            // Cari karyawan berdasarkan ID
            $karyawan = Karyawan::findOrFail($id);
            return view('karyawan.show', compact('karyawan'));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('karyawan.index')
                ->with('error', 'Data karyawan tidak ditemukan.');
                
        } catch (\Exception $e) {
            return redirect()->route('karyawan.index')
                ->with('error', 'Gagal memuat detail karyawan: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan form edit karyawan
     */
    public function edit($id)
    {
        try {
            $karyawan = Karyawan::findOrFail($id);
            $users = User::all();
            return view('karyawan.edit', compact('karyawan', 'users'));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('karyawan.index')
                ->with('error', 'Data karyawan tidak ditemukan.');
                
        } catch (\Exception $e) {
            return redirect()->route('karyawan.index')
                ->with('error', 'Gagal memuat form edit: ' . $e->getMessage());
        }
    }

    /**
     * Update data karyawan
     */
    public function update(Request $request, $id)
    {
        try {
            $karyawan = Karyawan::findOrFail($id);
    
            /* VALIDASI */
            $validated = $request->validate([
                'name_user'      => 'required|string|max:255',
                'nik'            => [
                    'required',
                    Rule::unique('tb_karyawan','nik')->ignore($karyawan->id),
                ],
                'nama_lengkap'   => 'required|string|max:255',
                'email'          => 'nullable|email|max:255',
                'hp'             => 'nullable',
                'tempat_lahir'   => 'nullable',
                'tgl_lahir'      => 'nullable|date',
                'alamat'         => 'nullable',
                'area_kerja'     => 'nullable|string|max:100',
                'jabatan'        => 'required|string|max:100',
                'tanggal_gabung' => 'required|date',
                'akhir_kontrak'  => 'nullable|date',
                'rekening'       => 'nullable|string|max:100',
                'Status'         => 'required|in:Aktif,Non-Aktif',
    
                // upload opsional
                'berkas1'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'berkas2'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
                'berkas3'        => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            ]);
    
            DB::beginTransaction();
    
            /* HANDLE FILE UPLOAD */
            foreach (['berkas1','berkas2','berkas3'] as $file) {
            
                // jika ada file baru
                if ($request->hasFile($file)) {
            
                    // hapus file lama jika ada
                    if ($karyawan->$file && Storage::disk('public')->exists($karyawan->$file)) {
                        Storage::disk('public')->delete($karyawan->$file);
                    }
            
                    // simpan file baru
                    $validated[$file] = $request->file($file)
                        ->store('karyawan/berkas', 'public');
            
                } else {
                    // **tidak upload apa-apa → pakai nilai lama**
                    $validated[$file] = $karyawan->$file;
                }
            }

    
            /* SIMPAN PERUBAHAN */
            $karyawan->update($validated);
    
            DB::commit();
    
            return redirect()
                ->route('karyawan.index')
                ->with('success', 'Data karyawan berhasil diperbarui.');
    
        } catch (\Exception $e) {
    
            DB::rollBack();
    
            return back()
                ->with('error', 'Gagal update: '.$e->getMessage())
                ->withInput();
        }
    }



    /**
     * Hapus data karyawan
     */
    public function destroy($id)
    {
        try {
            $karyawan = Karyawan::findOrFail($id);
            $namaKaryawan = $karyawan->name_user;
            
            DB::beginTransaction();
            $karyawan->delete();
            DB::commit();

            return redirect()->route('karyawan.index')
                ->with('success', "Karyawan {$namaKaryawan} berhasil dihapus!");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus karyawan: ' . $e->getMessage());
        }
    }
}