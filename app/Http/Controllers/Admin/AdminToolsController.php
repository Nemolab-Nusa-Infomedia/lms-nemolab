<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Tools;


class AdminToolsController extends Controller
{
    // Menampilkan daftar tools
    public function index(Request $request) {
        // Ambil jumlah item per halaman dari parameter 'entries', default 10
        $perPage = $request->get('entries', 10);
        
        // Ambil semua data tools
        $tools = Tools::all();
        return view('admin.tools.view', compact('tools'));
    }

    // Menampilkan form untuk membuat tool baru
    public function create() {
        return view('admin.tools.create');
    }

    // Menyimpan tool baru ke dalam database
    public function store(Request $request) {
        // Validasi input dari form
        $request->validate([
            'name_tools' => 'required', // Nama tool wajib diisi
            'logo_tools' => 'required|image|mimes:jpeg,png,jpg', // Logo wajib berupa file gambar
            'link' => 'required|url', // Link wajib berupa URL
        ]);

        // Ambil file logo dari input
        $images = $request->file('logo_tools');
        
        // Buat nama baru untuk logo menggunakan string acak
        $imagesGetNewName = Str::random(10) . '.' . $images->getClientOriginalExtension();
        
        // Simpan logo ke direktori 'public/images/logoTools'
        $images->storeAs('public/images/logoTools', $imagesGetNewName);

        // Buat data tool baru di database
        Tools::create([
            'name_tools' => $request->name_tools,
            'logo_tools' => $imagesGetNewName, // Simpan nama logo baru
            'link' => $request->link,
        ]);
        Alert::success('Success', 'Tools Berhasil Di Buat');
        return redirect()->route('admin.tools');
    }

    // Menampilkan form untuk mengedit tool
    public function edit($id) {
        // Cari tool berdasarkan ID, jika tidak ditemukan, tampilkan 404
        $tools = Tools::findOrFail($id);
        
        // Kembalikan tampilan 'admin.tools.update' dengan data tool
        return view('admin.tools.update', compact('tools'));
    }

    // Memperbarui data tool di database
    public function update(Request $request, $id) {
        // Validasi input dari form
        $request->validate([
            'name_tools' => 'required', // Nama tool wajib diisi
            'link' => 'required|url', // Link wajib berupa URL
            'logo_tools' => 'sometimes|image|mimes:jpeg,png,jpg', // Logo opsional, tetapi harus berupa gambar jika diisi
        ]);

        // Cari tool berdasarkan ID
        $tools = Tools::findOrFail($id);

        // Periksa apakah ada logo baru
        if ($request->hasFile('logo_tools')) {
            // Ambil file logo baru
            $images = $request->file('logo_tools');
            
            // Buat nama baru untuk logo
            $imagesGetNewName = Str::random(10) . '.' . $images->getClientOriginalExtension();
            
            // Simpan logo baru ke direktori 'public/images/logoTools'
            $images->storeAs('public/images/logoTools', $imagesGetNewName);

            // Hapus logo lama dari storage
            Storage::disk('public')->delete('images/logoTools/' . $tools->logo_tools);

            // Perbarui nama logo pada data tool
            $tools->logo_tools = $imagesGetNewName;
        }

        // Perbarui data tool di database
        $tools->update([
            'name_tools' => $request->name_tools,
            'logo_tools' => $tools->logo_tools, // Gunakan logo baru jika ada
            'link' => $request->link,
        ]);
        Alert::success('Success', 'Tools Berhasil Di Update');
        return redirect()->route('admin.tools');
    }

    // Menghapus tool dari database
    public function delete($id) {
        // Cari tool berdasarkan ID
        $tools = Tools::findOrFail($id);
        
        // Hapus file logo dari storage
        Storage::disk('public')->delete('images/logoTools/' . $tools->logo_tools);
        
        // Hapus data tool dari database
        $tools->delete();
        Alert::success('Success', 'Tools Berhasil Di Hapus');
        return redirect()->route('admin.tools');
    }
}
