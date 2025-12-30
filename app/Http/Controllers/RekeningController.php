<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    public function index()
    {
        //$rekening = Rekening::orderBy('bank')->get();
        // 10 data per halaman (silakan ubah sesuai kebutuhan)
        $rekening = Rekening::orderBy('bank')
            ->paginate(10)
            ->withQueryString();

        return view('rekening.index', compact('rekening'));
    }
    
    public function create()
    {
        try {
            return view('rekening.create');
    
        } catch (\Exception $e) {
            return redirect()->route('rekening.index')
                ->with('error', 'Gagal membuka form tambah rekening: ' . $e->getMessage());
        }
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'bank'        => 'required|string|max:50',
            'kode_bank'   => 'required|string|max:50',
        ]);

        Rekening::create($request->all());

        //return back()->with('success', 'Rekening berhasil ditambahkan');
        return redirect()
            ->route('rekening.index')
            ->with('success', 'Bank berhasil ditambahkan');
    }
    
    //edit
    public function edit($id)
    {
        $rekening = Rekening::findOrFail($id);
    
        return view('rekening.edit', compact('rekening'));
    }
    
    public function update(Request $request, $id)
    {
        $rekening = Rekening::findOrFail($id);
    
        $validated = $request->validate([
            'bank'        => 'required|string|max:50',
            'kode_bank'   => 'required|string|max:50',
        ]);
    
        $rekening->update($validated);
    
        return redirect()->route('rekening.index')
            ->with('success', 'Rekening berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Rekening::findOrFail($id)->delete();

        return back()->with('success', 'Rekening berhasil dihapus');

    }
}
