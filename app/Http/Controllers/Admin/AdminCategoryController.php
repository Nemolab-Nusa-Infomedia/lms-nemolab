<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Category;

class AdminCategoryController extends Controller
{
    // Method untuk menampilkan daftar kategori
    public function index(Request $request)
    {
        $perPage = $request->get('entries', 10); // Menentukan jumlah data per halaman (default: 10)
        $categories = Category::paginate($perPage); // Mengambil data kategori dengan pagination
        return view('admin.category.view', compact('categories')); // Menampilkan view dengan data kategori
    }

    // Method untuk menampilkan halaman form pembuatan kategori
    public function create()
    {
        return view('admin.category.create'); // Menampilkan form untuk membuat kategori baru
    }

    // Method untuk menyimpan data kategori baru
    public function store(Request $request)
    {
        // Validasi input form
        $request->validate([
            'name' => 'required|string|max:255', // Nama kategori wajib diisi, berupa string, maksimal 255 karakter
        ]);

        // Periksa apakah nama kategori sudah ada di database
        $check = Category::where('name', strtolower($request->name))->first();
        
        if (!$check) {
            // Jika belum ada, buat kategori baru
            $category = Category::create([
                'name' => $request->name,
            ]);
            
            Alert::success('Success', 'Category Berhasil Di Buat')->toast()->position('top-end'); 
        } else {
            // Jika sudah ada, tampilkan pesan error
            Alert::error('Error', 'Maaf Kategori Sudah Pernah Dibuat!')->toast()->position('top-end');
            return redirect()->route('admin.category.create'); // Kembalikan ke halaman create
        }
        
        return redirect()->route('admin.category'); 
    }

    // Method untuk menampilkan halaman edit kategori
    public function edit($id)
    {
        $category = Category::findOrFail($id); // Cari kategori berdasarkan ID (404 jika tidak ditemukan)
        return view('admin.category.update', compact('category')); // Menampilkan form update dengan data kategori
    }

    // Method untuk memperbarui data kategori
    public function update(Request $request, $id)
    {
        // Validasi input form
        $request->validate([
            'name' => 'required|string|max:255', // Required untuk membuatnya wajib diisi dengan maks 255 karaktere
        ]);

        $category = Category::findOrFail($id)->first(); // Cari kategori berdasarkan ID.findOrFail berguna jika

        if ($category->name == $request->name) {
            $category->update([
                'name' => $request->name,
            ]);
    
            Alert::success('Success', 'Category Berhasil Di Update')->toast()->position('top-end'); 
        } else {
            // Jika nama kategori berubah, periksa apakah nama baru sudah ada
            $check = Category::where('name', $request->name)->first();
            if (!$check) {
                // Jika belum ada, update nama kategori
                $category->update([
                    'name' => $request->name,
                ]);
        
                Alert::success('Success', 'Category Berhasil Di Update')->toast()->position('top-end'); 
            } else {
                // Jika sudah ada, tampilkan pesan error
                Alert::error('Error', 'Maaf Kategori Sudah Pernah Dibuat!')->toast()->position('top-end');
                return redirect()->route('admin.category.edit', $id); 
            }
        }
        
        return redirect()->route('admin.category'); 
    }

    // Method untuk menghapus kategori
    public function delete($id)
    {
        $category = Category::findOrFail($id); // Cari kategori berdasarkan ID. kegunaan findOrFail jika gagal akan menampilkan 404
        $category->delete(); // Hapus kategori

        Alert::success('Success', 'Category Berhasil Di Hapus')->toast()->position('top-end'); 
        return redirect()->route('admin.category'); 
    }
}
