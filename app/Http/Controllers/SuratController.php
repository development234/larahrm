<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratController extends Controller
{
    public function index()
    {
        $surat = Surat::orderBy('tanggal', 'desc')->get();
        return view('surat.index', compact('surat'));
    }

    public function create()
    {
        return view('surat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'perihal' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'berkas_surat' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'status' => 'required|in:draft,dikirim,diterima,ditolak'
        ]);

        $data = $request->all();

        if ($request->hasFile('berkas_surat')) {
            $file = $request->file('berkas_surat');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('surat', $fileName, 'public');
            $data['berkas_surat'] = $fileName;
        }

        Surat::create($data);

        return redirect()->route('surat.index')
            ->with('success', 'Surat berhasil dibuat.');
    }

    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        return view('surat.show', compact('surat'));
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        return view('surat.edit', compact('surat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'perihal' => 'required|string|max:255',
            'tujuan' => 'required|string|max:255',
            'berkas_surat' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'status' => 'required|in:draft,dikirim,diterima,ditolak'
        ]);

        $surat = Surat::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('berkas_surat')) {
            // Hapus file lama jika ada
            if ($surat->berkas_surat) {
                Storage::disk('public')->delete('surat/' . $surat->berkas_surat);
            }

            $file = $request->file('berkas_surat');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('surat', $fileName, 'public');
            $data['berkas_surat'] = $fileName;
        }

        $surat->update($data);

        return redirect()->route('surat.index')
            ->with('success', 'Surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);

        // Hapus file jika ada
        if ($surat->berkas_surat) {
            Storage::disk('public')->delete('surat/' . $surat->berkas_surat);
        }

        $surat->delete();

        return redirect()->route('surat.index')
            ->with('success', 'Surat berhasil dihapus.');
    }

    public function download($id)
    {
        $surat = Surat::findOrFail($id);
        
        if (!$surat->berkas_surat) {
            return redirect()->back()->with('error', 'Berkas surat tidak ditemukan.');
        }

        $filePath = storage_path('app/public/surat/' . $surat->berkas_surat);

        if (!file_exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        return response()->download($filePath);
    }
}