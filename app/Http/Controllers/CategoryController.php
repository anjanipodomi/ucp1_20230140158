<?php

namespace App\Http\Controllers;

use App\Models\Category; // memanggil model Category
use Illuminate\Http\Request; // digunakan untuk mengambil data dari form

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get(); 
        // mengambil semua data category dan menghitung jumlah product di tiap category

        return view('categories.index', compact('categories')); 
        // menampilkan halaman list category
    }

    public function create()
    {
        return view('categories.create'); 
        // menampilkan halaman form tambah category
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);
        // validasi agar nama category wajib diisi dan tidak boleh sama

        Category::create([
            'name' => $request->name,
        ]);
        // menyimpan data category baru ke database

        return redirect()->route('categories.index')->with('success', 'Category berhasil ditambahkan');
        // kembali ke halaman category dengan pesan sukses
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
        // menampilkan form edit sesuai category yang dipilih
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
        ]);
        // validasi nama wajib diisi, boleh sama hanya dengan data dirinya sendiri

        $category->update([
            'name' => $request->name,
        ]);
        // mengubah data category

        return redirect()->route('categories.index')->with('success', 'Category berhasil diupdate');
        // kembali ke halaman category dengan pesan sukses
    }

    public function destroy(Category $category)
    {
        $category->delete();
        // menghapus data category

        return redirect()->route('categories.index')->with('success', 'Category berhasil dihapus');
        // kembali ke halaman category dengan pesan sukses
    }
}