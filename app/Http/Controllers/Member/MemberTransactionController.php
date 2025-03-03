<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\detailTransactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Transaction;

class MemberTransactionController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            $status = $request->input('status') == "null" ? null : $request->input('status');
            $lastId = $request->input('lastId') == "null" ? null : $request->input('lastId');
            
            $itemsPerRow = $request->input('itemsPerRow') == false ? 1 : $request->input('itemsPerRow');
            $rowsToLoad = 10;
            $perLoad = $itemsPerRow * $rowsToLoad;

            $query = Transaction::with([
                'course' => function ($query) {
                    $query->select('id', 'name', 'cover', 'price');
                },
                'ebook' => function ($query) {
                    $query->select('id', 'name', 'cover', 'price');
                },
                'bundle.course' => function ($query) {
                    $query->select('id', 'name', 'cover', 'price');
                }
            ])
            ->where('user_id', Auth::id())
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc');

            if ($lastId) {
                $query->where('id', '<', $lastId);
            }

            $transactions = $query->limit($perLoad)->get();

            $lastId = $transactions->last() ? $transactions->last()->id : null;

            return response()->json([
                'data' => $transactions,
                'hasMore' => $transactions->count() >= $perLoad,
                'lastId' => $lastId
            ]);
        }

        return view('member.dashboard.transaction.view');
    }

    public function show(Request $requests, $transaction_code)
    {
        $transaction = Transaction::where('transaction_code', $transaction_code)->first();
        $details = detailTransactions::where('transaction_code', $transaction_code)->first();
        if ($transaction) {
            if (!$details) {
                return redirect()->route('member.transaction')->with('alert', ['type' => 'error', 'message' => 'Maaf terjadi kesalahan pada pembayaran']);
            }
    
            if ($transaction->status == 'success' || $transaction->status == 'failed') {
                return view('member.dashboard.transaction.show-payment', compact('details'));
            } else {
                return redirect()->route('member.transaction')->with('alert', ['type' => 'error', 'message' => 'Maaf Anda Tidak Bisa Akses Detail Transaction, Status Anda Masih Pending!!!']);
            }
        }
        return view('error.page404');
    }
    



    public function cancel($id)
    {
        $transaction = Transaction::findOrFail($id);
        $details = detailTransactions::where('transaction_code', $transaction->transaction_code);
        $transaction->delete();
        $details->delete();
        return redirect()->route('member.transaction')->with('alert', ['type' => 'error', 'message' => 'Transaction Berhasil Di Cancel']);
    }

}
