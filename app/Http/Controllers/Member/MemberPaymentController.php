<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Env;

use App\Models\Transaction;
use App\Models\Course;
use App\Models\Ebook;
use App\Models\MyListCourse;

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
            $price = $request->price;
        }

        if ($course->price == 0) {
            $status = 'success';
        }

        $checkTransaction = Transaction::where('course_id', $courseId)
            ->where('user_id', Auth::user()->id)
            ->where('status', 'pending')
            ->first();

        if (!isset($checkTransaction)) {
            if ($status == 'success') {
                Transaction::create([
                    'user_id' => $User->id,
                    'transaction_code' => $transaction_code,
                    'snap_token' => '',
                    'course_id' => $courseId,
                    'ebook_id' => $ebookId,
                    'name' => $name,
                    'price' => $price,
                    'status' => $status,
                ]);

                MyListCourse::create([
                    'user_id' => Auth::user()->id,
                    'course_id' => $courseId,
                ]);
                Alert::success('success', 'Kelas Berhasil Di Beli');
                return redirect()->route('member.course.join', $course->slug);
            } else {
                // Jangan Hapus
                // Set your Merchant Server Key
                \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
                // Set to Production Environment (accept real transaction)
                \Midtrans\Config::$isProduction = env('MIDTRANS_PRODUCTION');
                // Set sanitization on (default)
                \Midtrans\Config::$isSanitized = true;
                // Set 3DS transaction for credit card to true
                \Midtrans\Config::$is3ds = true;

                $params = [
                    'transaction_details' => [
                        'order_id' => $transaction_code,
                        'gross_amount' => intval($price),
                    ],
                    'customer_details' => [
                        'name' => $User->name,
                        'email' => $User->email,
                    ],
                    'callbacks' => [
                        'finish' => route('member.transaction.detail.view', $transaction_code),
                    ],
                ];

                $createdTransactionMidtrans = \Midtrans\Snap::createTransaction($params);
                $midtransRedirectUrl = $createdTransactionMidtrans->redirect_url;
                Transaction::create([
                    'user_id' => $User->id,
                    'transaction_code' => $transaction_code,
                    'snap_token' => $createdTransactionMidtrans->token,
                    'course_id' => $courseId,
                    'ebook_id' => $ebookId,
                    'name' => $name,
                    'price' => $price,
                    'status' => $status,
                ]);

                return redirect($midtransRedirectUrl);
            }
        } else {
            $url = "https://app.sandbox.midtrans.com/snap/v4/redirection/$checkTransaction->snap_token";
            if (env('MIDTRANS_PRODUCTION') === true) {
                $url = "https://app.midtrans.com/snap/v4/redirection/$checkTransaction->snap_token";
            }

            return redirect($url);
        }
    }

    public function checkout()
    {
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_PRODUCTION');
        $notif = new \Midtrans\Notification();

        $transactionStatus = $notif->transaction_status;
        $type = $notif->payment_type;
        $transaction_code = $notif->order_id;
        $fraudStatus = $notif->fraud_status;

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'accept') {
                $status = 'success';
            }
        } elseif ($transactionStatus == 'settlement') {
            $status = 'success';
        } elseif ($transactionStatus == 'cancel' || $transactionStatus == 'deny' || $transactionStatus == 'expire') {
            $status = 'failed';
        } elseif ($transactionStatus == 'pending') {
            $status = 'pending';
        }

        $transaction = Transaction::where('transaction_code', $transaction_code)->first();
        $transaction->update(['status' => $status]);

        if ($status == 'success') {
            try {
                MyListCourse::create([
                    'user_id' => $transaction->user_id,
                    'course_id' => $transaction->course_id, // Pastikan ini valid
                ]);
            } catch (\Exception $e) {
                \Log::error('Failed to create MyListCourse: ' . $e->getMessage());
            }
        }
    }

    public function viewTransaction(Request $requests, $transaction_code)
    {
        $transaction = Transaction::where('transaction_code', $transaction_code)->first();

        $url = "https://app.sandbox.midtrans.com/snap/v4/redirection/$transaction->snap_token";
        if (env('MIDTRANS_PRODUCTION') === true) {
            $url = "https://app.midtrans.com/snap/v4/redirection/$transaction->snap_token";
        }

        return redirect()->to($url);
    }

    public function detailTransaction(Request $requests, $transaction_code)
    {
        $transaction = Transaction::where('transaction_code', $transaction_code)->first();
        if ($transaction && $transaction->status != 'pending') {
            return view('member.dashboard.transaction.detail-payment', compact('transaction'));
        } else {
            return view('error.page404');
        }
    }

    // public function callback() {
    //     $course = Course::where('id', $courseId)->first();
    //     return url('/course/join/' . $course->slug);
    // }

    // public function test()
    // {
    //     $client = new \GuzzleHttp\Client();

    //     try {
    //         $response = $client->request('GET', 'https://api.sandbox.midtrans.com/v2/NEMOLAB-RUAH0Z0ADU/status', [
    //             'headers' => [
    //                 'accept' => 'application/json',
    //                 'authorization' => 'Basic U0ItTWlkLXNlcnZlci1pNU9GbWpiR1ppSGc5cVBHVmg3MHdHcTI6',
    //             ],
    //         ]);

    //         $responseBody = $response->getBody()->getContents();
    //         $responseData = json_decode($responseBody, true); // Mengubah JSON menjadi array

    //         // Mengambil object transaction_status
    //         $transactionStatus = $responseData['transaction_status'];

    //         echo $transactionStatus;
    //     } catch (\GuzzleHttp\Exception\RequestException $e) {
    //         // Handle the exception, for example, log the error
    //         if ($e->hasResponse()) {
    //             $errorResponse = $e->getResponse()->getBody()->getContents();
    //             echo $errorResponse; // Show error response
    //         } else {
    //             echo $e->getMessage(); // Show the error message
    //         }
    //     }
    // }
}
