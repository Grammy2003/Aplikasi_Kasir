<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    /**
     * Menampilkan daftar satuan.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $satuans = Satuan::when($search, function ($query, $search) {
            return $query->where('nama_satuan', 'like', "%{$search}%")
                         ->orWhere('deskripsi', 'like', "%{$search}%");
        })->paginate(10);

        return view('satuans.index', compact('satuans'));
    }

    /**
     * Menampilkan form untuk membuat satuan baru.
     */
    public function create()
    {
        return view('satuans.create');
    }

    /**
     * Menyimpan satuan baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_satuan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Satuan::create([
            'nama_satuan' => $request->nama_satuan,
            'deskripsi' => $request->deskripsi ?? '',
        ]);

        return redirect()->route('satuans.index')->with('success', 'Satuan berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit satuan.
     */
    public function edit($satuanID)
{
    $satuan = Satuan::findOrFail($satuanID);
    return view('satuans.edit', compact('satuan'));
}


    /**
     * Memperbarui data satuan.
     */
    public function update(Request $request, $satuanID)
{
    $request->validate([
        'nama_satuan' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ]);

    $satuan = Satuan::findOrFail($satuanID);
    $satuan->update([
        'nama_satuan' => $request->nama_satuan,
        'deskripsi' => $request->deskripsi,
    ]);

    return redirect()->route('satuans.index')->with('success', 'Satuan berhasil diperbarui.');
}


    /**
     * Menghapus satuan dari database.
     */
    public function destroy($satuanID)
    {
        $satuans = Satuan::findOrFail($satuanID);
        $satuans->delete();

        return redirect()->route('satuans.index')->with('success', 'Satuan berhasil dihapus.');
    }
}
