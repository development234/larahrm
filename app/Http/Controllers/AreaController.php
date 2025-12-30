<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function index()
    {
        //$area = Area::orderBy('nama_area')->get();
        
        // 10 data per halaman (boleh ubah jadi 5 / 25 / dll)
        $area = Area::orderBy('nama_area')->paginate(10);
        
        return view('area.index', compact('area'));
    }
    
        public function create()
    {
        return view('area.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_area' => 'required|min:3|max:100',
            'kota'      => 'required|min:3|max:100',
        ]);

        Area::create($request->only('nama_area','kota'));

        return redirect()->route('area.index')
            ->with('success', 'Data area berhasil ditambahkan.');
    }

        public function edit($id)
        {
            $area = Area::findOrFail($id);
        
            return view('area.edit', compact('area'));
        }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'nama_area' => 'required|min:3|max:100',
            'kota'      => 'required|min:3|max:100',
        ]);

        $area->update($request->only('nama_area','kota'));

        return redirect()->route('area.index')
            ->with('success', 'Data area berhasil diperbarui.');
    }

    public function destroy(Area $area)
    {
        $area->delete();

        return redirect()->route('area.index')
            ->with('success', 'Data area berhasil dihapus.');
    }
}
