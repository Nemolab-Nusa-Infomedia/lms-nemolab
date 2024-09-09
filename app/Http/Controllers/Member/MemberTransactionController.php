<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Transaction;


class MemberTransactionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $transactions = Transaction::with('course')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('member.dashboard.transaction.view', compact('transactions'));
    }

    public function cancel($id)
    {
        $transaction = Transaction::where('id', $id);

        $transaction->delete();
        Alert::success('Success', 'Transaction Berhasil Di Cancel');
        return redirect()->route('member.transaction');
    }
}