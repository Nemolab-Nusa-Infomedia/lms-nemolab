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
        
        // Mengirim data diskon ke tampilan 'admin.diskon-kelas.view'
        return view('admin.diskon-kelas.view', compact('diskonKelas'));
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
            'kode_diskon' => 'required', // Kode diskon wajib diisi
            'rate_diskon' => 'required|numeric|min:0|max:100', // Rate diskon harus berupa angka 0-100
        ]);

        // Mengecek apakah kode diskon sudah ada
        $diskon = DiskonKelas::where('kode_diskon', $requests->kode_diskon)->first();

        if (!$diskon) {
            // Jika kode diskon belum ada, buat data baru
            DiskonKelas::create([
                'kode_diskon' => $requests->kode_diskon,
                'rate_diskon' => $requests->rate_diskon
            ]);
        } else {
            // Jika kode diskon sudah ada, tampilkan pesan error
            Alert::error('Error', 'Maaf Diskon Sudah Pernah Buat!');
            return redirect()->back(); // Kembali ke halaman sebelumnya
        }

        // Tampilkan pesan sukses dan redirect ke daftar diskon
        Alert::success('Success', 'Diskon Berhasil Di Buat');
        return redirect()->route('admin.diskon-kelas');
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
            'kode_diskon' => 'required', // Kode diskon wajib diisi
            'rate_diskon' => 'required|numeric|min:0|max:100', // Rate diskon harus berupa angka 0-100
        ]);

        // Mendapatkan data diskon berdasarkan ID
        $diskon = DiskonKelas::where('id', $id)->first();

        // Mengupdate data diskon
        $diskon->update([
            'kode_diskon' => $requests->kode_diskon,
            'rate_diskon' => $requests->rate_diskon
        ]);

        // Tampilkan pesan sukses dan redirect ke daftar diskon
        Alert::success('Success', 'Diskon Berhasil Di Update');
        return redirect()->route('admin.diskon-kelas');
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
        Alert::success('Success', 'Diskon Berhasil Di Delete');
        return redirect()->route('admin.diskon-kelas');
    }

}
