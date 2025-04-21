<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\TransaksiPenjualan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $pelanggans = Pelanggan::with('penjualan')
        ->when($search, function ($query, $search) {
            return $query->where('namapelanggan', 'like', "%{$search}%")
                ->orWhere('no_tlp', 'like', "%{$search}%")
                ->orWhereHas('penjualan', function ($q) use ($search) {
                    $q->where('PenjualanID', 'like', "%{$search}%");
                });
        })
        ->paginate(10);

    return view('pelanggans.index', compact('pelanggans'));
}

    public function create()
    {
        return view('pelanggans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namapelanggan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_tlp' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        Pelanggan::create($request->all());
        return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::with('penjualan')->findOrFail($id);
        return view('pelanggans.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'namapelanggan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_tlp' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->update($request->all());

        return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy($id)
{
    $pelanggan = Pelanggan::findOrFail($id);

    // Hapus semua transaksi terkait terlebih dahulu
    $pelanggan->penjualan()->delete();

    // Hapus pelanggan setelah semua transaksi dihapus
    $pelanggan->delete();
    
    return redirect()->route('pelanggans.index')->with('success', 'Pelanggan berhasil dihapus.');
}


}