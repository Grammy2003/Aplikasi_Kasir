<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
   

    public function index(Request $request)
    {
        $search = $request->input('search');
        $user = Auth::user();
    
        $products = Product::with(['category', 'supplier'])
            ->when($search, function ($query, $search) use ($user) {
                if ($user->role === 'kasir') {
                    return $query->where('nama_produk', 'like', "%{$search}%");
                } else {
                    return $query->where('nama_produk', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($q) use ($search) {
                            $q->where('nama_category', 'like', "%{$search}%");
                        })
                        ->orWhereHas('supplier', function ($q) use ($search) {
                            $q->where('nama_supplier', 'like', "%{$search}%");
                        });
                }
            })
            ->paginate(10);
    
        return view('products.index', compact('products', 'search'));
    }
    

    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        $satuans = Satuan::all();
        return view('products.create', compact('categories', 'suppliers', 'satuans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'categoryID' => 'required|exists:categories,categoryID',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'satuanID' => 'required|exists:satuans,satuanID',
            'supplierID' => 'required|exists:suppliers,supplierID',
        ]);

        Product::create([
            'nama_produk' => $request->nama_produk,
            'categoryID' => $request->categoryID,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'satuanID' => $request->satuanID,
            'supplierID' => $request->supplierID,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id); // Cari produk berdasarkan ID
            $categories = Category::all(); // Ambil semua kategori
            $suppliers = Supplier::all(); // Ambil semua supplier
            $satuans = Satuan::all();

            return view('products.edit', compact('product', 'categories', 'suppliers', 'satuans'));

        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan!');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'categoryID' => 'required|exists:categories,categoryID',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'satuanID' => 'required|exists:satuans,satuanID',
            'supplierID' => 'required|exists:suppliers,supplierID',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'nama_produk' => $request->nama_produk,
            'categoryID' => $request->categoryID,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'satuanID' =>$request->satuanID,
            'supplierID' => $request->supplierID,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
