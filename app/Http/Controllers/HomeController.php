<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Pelanggan;
use App\Models\Product;
use App\Models\TransaksiPenjualan;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Hitung jumlah data dari masing-masing tabel
        $jumlahSupplier = Supplier::count();
        $jumlahPelanggan = Pelanggan::count();
        $jumlahProduk = Product::count();
        $jumlahTransaksi = TransaksiPenjualan::count();
        $role = Auth::user()->role; // Ambil role user yang login

        // Kirim data ke view
        return view('home', compact('jumlahSupplier', 'jumlahPelanggan', 'jumlahProduk', 'jumlahTransaksi','role'));
    }
}