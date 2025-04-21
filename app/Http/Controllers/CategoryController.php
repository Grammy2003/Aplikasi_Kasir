<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // Pastikan model Category sudah dibuat

class CategoryController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');

    $categories = Category::when($search, function ($query, $search) {
        return $query->where('nama_category', 'like', "%{$search}%")
                     ->orWhere('deskripsi', 'like', "%{$search}%");
    })->paginate(10);

    return view('categories.index', compact('categories'));
}


    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('categories.create'); // Tampilkan form create
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_category' => 'required|string|max:255',
            'deskripsi' => 'nullable|string', // Jika deskripsi boleh kosong
        ]);

        // Insert data ke database menggunakan Eloquent
        Category::create([
            'nama_category' => $request->nama_category,
            'deskripsi' => $request->deskripsi ?? '', // Jika kosong, gunakan string kosong
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit kategori.
     */
    public function edit($categoryID)
    {
        $category = Category::findOrFail($categoryID); // Cari kategori, jika tidak ditemukan, error 404
        return view('categories.edit', compact('category')); // Tampilkan form edit
    }

    /**
     * Memperbarui kategori di database.
     */
    public function update(Request $request, $categoryID)
    {
        // Validasi input
        $request->validate([
            'nama_category' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        // Update data kategori
        $category = Category::findOrFail($categoryID);
        $category->update([
            'nama_category' => $request->nama_category,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori dari database.
     */
    public function destroy($categoryID)
    {
        $category = Category::findOrFail($categoryID); // Cari kategori, jika tidak ditemukan, error 404
        $category->delete(); // Hapus kategori

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
