<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Transaction;

class AdminTransactionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $userId = Auth::id();

        if (Auth::user()->role == 'superadmin') {
            // Jika user adalah superadmin, tampilkan semua transaksi
            $transactions = Transaction::with('course')
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
        } else {
            // Jika user bukan superadmin, tampilkan transaksi berdasarkan mentor_id
            $transactions = Transaction::with('course')->where('user_id', $userId)->orderBy('created_at', 'desc')->paginate($perPage);//
        }

        return view('admin.transaction.view', compact('transactions'));
    }

    public function accept($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'success';
        $transaction->save();

        Alert::success('Success', 'Transctions Berhasil Di Accept');
        return redirect()->route('admin.transaction');
    }

    public function cancel($id)
    {
        // $transaction = Transaction::findOrFail($id);
        // $transaction->delete();
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'failed';
        $transaction->save();

        Alert::success('Success', 'Transctions Berhasil Di Cancel');
        return redirect()->route('admin.transaction');
    }
}