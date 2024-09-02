<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Course;
use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class MemberPaymentController extends Controller
{
    public function index(Request $request)
    {
        $courseId = $request->query('course_id');

        $course = Course::find($courseId);

        return view('member.payment', [
            'course' => $course,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'nullable|exists:tbl_courses,id',
            'ebook_id' => 'nullable|exists:tbl_ebooks,id',
            'price' => 'required',
            'termsCheck' => 'required|accepted',
        ]);

        $courseId = $request->input('course_id');
        $ebookId = $request->input('ebook_id');
        $User = Auth::user();
        $transaction_code = 'NEMOLAB-' . strtoupper(Str::random(10));

        $name = '';
        $price = 0;
        $status = 'pending';
        $course = Course::where('id', $courseId)->first();

        if ($courseId) {
            $name = $course->name . ' (video)';
            $price = $course->price;
        }

        if ($course->price == 0) {
            $status = 'success';
        }

        // Save transaction
        $transaction = Transaction::create([
            'user_id' => $User->id,
            'transaction_code' => $transaction_code,
            'course_id' => $courseId,
            'ebook_id' => $ebookId,
            'name' => $name,
            'price' => $request->price,
            'status' => $status,
        ]);

        if ($status == 'success') {
            Alert::success('success', 'Kelas Berhasil Di Beli');
            return redirect()->route('member.course.join', $course->slug);
        }

        // Jangan Hapus
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = "SB-Mid-server-pM9HTKiXn0FWO_P34gPkb5Vm";
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $transaction_code,
                'gross_amount' => $price,
            ),
            'customer_details' => array(
                'name' => $User->name,
                'email' => $User->email,
            ),
        );

        $createdTransactionMidtrans = \Midtrans\Snap::createTransaction($params);
        $midtransRedirectUrl = $createdTransactionMidtrans->redirect_url;
        return redirect($midtransRedirectUrl);
    }

    
    public function checkout()
    {
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$serverKey = "SB-Mid-server-pM9HTKiXn0FWO_P34gPkb5Vm";
        $notif = new \Midtrans\Notification();

        $transactionStatus = $notif->transaction_status;
        $type = $notif->payment_type;
        $transaction_code = $notif->order_id;
        $fraudStatus = $notif->fraud_status;

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                $status = 'success';
            }
        } else if ($transactionStatus == 'settlement') {
            $status = 'success';
        } else if (
            $transactionStatus == 'cancel' ||
            $transactionStatus == 'deny' ||
            $transactionStatus == 'expire'
        ) {
            $status = 'failed';
        } else if ($transactionStatus == 'pending') {
            $status = 'pending';
        }

        $transaction = Transaction::where('transaction_code', $transaction_code)->first();
        $transaction->update(['status' => $status]);

        return redirect()->route('member.course');
    }
}