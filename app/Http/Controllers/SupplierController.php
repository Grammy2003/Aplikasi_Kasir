<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Menampilkan daftar supplier.
     */
    public function index(Request $request)
    { 
        $search = $request->input('search');
    
        $query = Supplier::query(); 
    
        if (!empty($search)) {
            $query->where('nama_supplier', 'LIKE', "%$search%")
                  ->orWhere('no_tlp', 'LIKE', "%$search%")
                  ->orWhere('email_supplier', 'LIKE', "%$search%");
        }
    
        $suppliers = $query->paginate(10); 
    
        return view('suppliers.index', compact('suppliers', 'search')); 
    }

    /**
     * Menampilkan form untuk membuat supplier baru.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Menyimpan supplier baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'no_tlp' => 'required|string|max:15',
            'email_supplier' => 'required|email|unique:suppliers,email_supplier',
        ]);

        Supplier::create($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit supplier.
     */
    public function edit($supplierID)
    {
        $supplier = Supplier::findOrFail($supplierID);
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Mengupdate supplier di database.
     */
    public function update(Request $request, $supplierID)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'no_tlp' => 'required|string|max:15',
            'email_supplier' => 'required|email|unique:suppliers,email_supplier,' . $supplierID . ',supplierID',
        ]);

        $supplier = Supplier::findOrFail($supplierID);
        $supplier->update($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Menghapus supplier dari database.
     */
    public function destroy($supplierID)
    {
        $supplier = Supplier::findOrFail($supplierID);
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Supplier berhasil dihapus.');
    }
}
