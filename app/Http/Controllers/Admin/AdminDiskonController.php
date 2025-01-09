<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\DiskonKelas;

class AdminDiskonController extends Controller
{
    // Menampilkan daftar diskon kelas
    public function index()
    {
        // Mendapatkan semua data dari tabel DiskonKelas
        $diskonKelas = DiskonKelas::all();
        $diskon = new DiskonKelas(); // Tambahkan ini untuk form update
        
        // Mengirim data diskon ke tampilan 'admin.diskon-kelas.view'
        return view('admin.diskon-kelas.view', compact('diskonKelas', 'diskon'));
    }

    // Menampilkan halaman form untuk membuat diskon baru
    public function create()
    {
        return view('admin.diskon-kelas.create');
    }

    // Menyimpan data diskon baru ke database
    public function store(Request $requests)
    {
        // Validasi input
        $requests->validate([
            'kode_diskon' => 'required',
            'rate_diskon' => 'required|numeric|min:0|max:100',
        ]);
    
        // Mengecek apakah kode diskon sudah ada
        $diskon = DiskonKelas::where('kode_diskon', $requests->kode_diskon)->first();
    
        if (!$diskon) {
            DiskonKelas::create([
                'kode_diskon' => $requests->kode_diskon,
                'rate_diskon' => $requests->rate_diskon
            ]);
            return redirect()->route('admin.diskon-kelas')->with('alert', ['type' => 'success', 'message' => 'Data Berhasil Dibuat!']);
        } else {
            return redirect()->back()
                ->withErrors(['kode_diskon' => 'Diskon Sudah Pernah dibuat'])
                ->withInput();
        }
    }

    // Menampilkan halaman edit diskon
    public function edit(Request $requests)
    {
        // Mendapatkan ID diskon dari parameter query
        $id = $requests->query('id');
        
        // Mengambil data diskon berdasarkan ID
        $diskon = DiskonKelas::where('id', $id)->first();
        
        // Mengirim data diskon ke tampilan 'admin.diskon-kelas.update'
        return view('admin.diskon-kelas.update', compact('diskon'));
    }

    // Memperbarui data diskon di database
    public function update(Request $requests, $id)
    {
        // Validasi input
        $requests->validate([
            'kode_diskon' => 'required',
            'rate_diskon' => 'required|numeric|min:0|max:100',
        ]);
    
        $diskon = DiskonKelas::findOrFail($id);
        
        $existingDiskon = DiskonKelas::where('kode_diskon', $requests->kode_diskon)
            ->where('id', '!=', $id)
            ->first();
        
        if ($existingDiskon) {
            return redirect()->back()
                ->withErrors(['kode_diskon' => 'Kode diskon sudah digunakan'])
                ->withInput();
        }
    
        $diskon->update([
            'kode_diskon' => $requests->kode_diskon,
            'rate_diskon' => $requests->rate_diskon
        ]);
    
        return redirect()->route('admin.diskon-kelas')->with('alert', ['type' => 'info', 'message' => 'Data Berhasil Diubah!']);
    }

    // Menghapus data diskon dari database
    public function delete(Request $requests)
    {
        // Mendapatkan ID diskon dari parameter query
        $id = $requests->query('id');

        // Mengambil data diskon berdasarkan ID
        $diskon = DiskonKelas::where('id', $id)->first();

        // Menghapus data diskon
        $diskon->delete();

        // Tampilkan pesan sukses dan redirect ke daftar diskon
        return redirect()->route('admin.diskon-kelas')->with('alert', ['type' => 'error', 'message' => 'Data Berhasil Dihapus!']);
    }

}
