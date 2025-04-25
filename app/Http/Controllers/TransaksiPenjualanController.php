<?php

namespace App\Http\Controllers;

use App\Models\TransaksiPenjualan;
use App\Models\Pelanggan;
use App\Models\Product;
use App\Models\Detail;
use Illuminate\Http\Request;

class TransaksiPenjualanController extends Controller
{
    /**
     * Menampilkan daftar transaksi penjualan.
     */
    public function index(Request $request)
    {
        // Mendapatkan input pencarian
        $search = $request->input('search');

        // Inisialisasi query dengan model TransaksiPenjualan dan relasi `details.product`
        $query = TransaksiPenjualan::with('details.product');

        // Jika ada input pencarian, tambahkan kondisi pencarian
        if ($search) {
            $query->where('TglPenjualan', 'like', '%' . $search . '%')
                ->orWhereHas('pelanggan', function ($q) use ($search) {
                    $q->where('namapelanggan', 'like', '%' . $search . '%');
                })
                ->orWhereHas('details.product', function ($q) use ($search) {
                    $q->where('nama_produk', 'like', '%' . $search . '%');
                });
        }

        // Ambil hasil query dengan pagination
        $transaksi_penjualans = $query->orderBy('PenjualanID', 'desc')->paginate(10);

        // Kirim data ke view
        return view('transaksi_penjualans.index', compact('transaksi_penjualans', 'search'));
    }

    /**
     * Menampilkan form untuk membuat transaksi baru.
     */
    public function create()
    {
        $pelanggans = Pelanggan::all(); 
        $products = Product::all();

        return view('transaksi_penjualans.create', compact('pelanggans', 'products'));
    }

    /**
     * Menyimpan transaksi penjualan baru.
     */
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            // PelangganID hanya divalidasi kalau diisi
            'PelangganID' => 'nullable|exists:pelanggans,PelangganID',
            'TglPenjualan' => 'required|date',
            'TotalHarga' => 'required|numeric',
            'UangBayar' => 'required|numeric',
            'Kembali' => 'required|numeric',
            'DetailID' => 'required|array|min:1',
            'DetailID.*.produkID' => 'required|exists:products,produkID',
            'DetailID.*.kuantitas' => 'required|integer|min:1',
        ]);
    
        // Cek stok cukup
        foreach ($request->DetailID as $detail) {
            $product = Product::findOrFail($detail['produkID']);
    
            if ($detail['kuantitas'] > $product->stok) {
                return back()->withErrors([
                    'message' => 'Stok tidak cukup untuk produk ' . $product->nama_produk . 
                    ' (Tersedia: ' . $product->stok . ')'
                ]);
            }
        }
    
        // Simpan transaksi
        $transaksi_penjualan = TransaksiPenjualan::create([
            'PelangganID' => $request->filled('PelangganID') ? $request->PelangganID : null,
            'TglPenjualan' => $request->TglPenjualan,
            'TotalHarga' => $request->TotalHarga,
            'UangBayar' => $request->UangBayar,
            'Kembali' => $request->Kembali,
        ]);
    
        // Simpan detail & kurangi stok
        foreach ($request->DetailID as $detail) {
            $product = Product::findOrFail($detail['produkID']);
    
            Detail::create([
                'PenjualanID' => $transaksi_penjualan->PenjualanID,
                'produkID' => $detail['produkID'],
                'kuantitas' => $detail['kuantitas'],
            ]);
    
            $product->stok -= $detail['kuantitas'];
            $product->save();
        }
    
        return redirect()->route('transaksi_penjualans.index')->with('success', 'Penjualan Berhasil Disimpan.');
    }
    

    /**
     * Menampilkan detail transaksi.
     */
    
public function destroy($id)
{
    // Cari transaksi berdasarkan ID
    $transaksi = TransaksiPenjualan::findOrFail($id);

    // Kembalikan stok produk sebelum menghapus transaksi
    foreach ($transaksi->details as $detail) {
        $product = Product::find($detail->produkID);
        if ($product) {
            $product->stok += $detail->kuantitas;
            $product->save();
        }
    }

    // Hapus detail transaksi terlebih dahulu
    $transaksi->details()->delete();

    // Hapus transaksi
    $transaksi->delete();

    return redirect()->route('transaksi_penjualans.index')->with('success', 'Transaksi berhasil dihapus.');
}
public function struk($id)
{
    // Ambil transaksi berdasarkan ID dan relasi 'details.product' & 'pelanggan'
    $transaksi = TransaksiPenjualan::with(['details.product', 'pelanggan'])->findOrFail($id);

    // Kirim data ke tampilan struk
    return view('transaksi_penjualans.struk', compact('transaksi'));


}

}