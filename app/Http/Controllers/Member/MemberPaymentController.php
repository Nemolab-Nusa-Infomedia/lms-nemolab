<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Log;


use App\Models\Transaction;
use App\Models\Course;
use App\Models\CourseEbook;
use App\Models\Ebook;
use App\Models\MyListCourse;
use App\Models\DiskonKelas;
use App\Models\detailTransactions;

class MemberPaymentController extends Controller
{
    public function index(Request $request)
    {
        $courseId = $request->query('course_id');
        $ebookId = $request->query('ebook_id');
        $bundleId = $request->query('bundle_id');

        $course = Course::find($courseId);
        $ebook = Ebook::find($ebookId);
        $bundle = CourseEbook::find($bundleId);
        $diskonKelas = DiskonKelas::all();
        return view('member.payment', [
            'course' => $course,
            'ebook' => $ebook,
            'bundle' => $bundle,
            'kelasDiskon' => $diskonKelas
        ]);
    }

    public function store(Request $request)
    {
        //vaidari data
        $request->validate([
            'course_id' => 'nullable|exists:tbl_courses,id',
            'ebook_id' => 'nullable|exists:tbl_ebooks,id',
            'bundle_id' => 'nullable|exists:tbl_course_ebooks,id',
            'price' => 'required|numeric',
            'diskon' => 'nullable|numeric',
            'termsCheck' => 'required|accepted',
        ]);
        //simpan data pada variabel
        $courseId = $request->input('course_id');
        $ebookId = $request->input('ebook_id');
        $bundleId = $request->input('bundle_id');
        $user = Auth::user();
        $transaction_code = 'NEMOLAB-' . strtoupper(Str::random(10)); //membuat string acak setelah NEMOLAB-.  (strtoupper digunakan agar string dihasilkann adalah kapital)

        $name = ''; //set name default kosong
        $price = 0; //set price default 0
        $hargaAwal = 0; //simpan harga awal
        $status = 'pending'; //status otomatis panding

        $course = Course::find($courseId); //isi data fari variabel
        $ebook = Ebook::find($ebookId);
        $bundle = CourseEbook::find($bundleId);
        $diskon = 0;

        // jika transaction course maka gunakan nama course 
        if ($course) {
            $name = $course->name;
            $harga = $course->price;
            $hargaAwal = $harga;
            if ($harga != 0) {
                $price = $harga * 1.11 + 5000; //harga akan * 1.11(ppn jika inign membuat PPN dinamis buat variabel guna menyimpan ppn) + 5000 (biaya perpelajar/fee)
            }
        // jika transaction ebook maka gunakan nama ebook 
        } elseif ($ebook) {
            $name = $ebook->name;
            $harga = $ebook->price;
            $hargaAwal = $harga;
            if ($harga != 0) {
                $price = $harga * 1.11 + 5000;
            }
        // jika transaction bundle maka gunakan nama course yang ada di bundle
        } elseif ($bundle) {
            $name = $bundle->course->name;
            $courseId = $bundle->course_id;
            $ebookId = $bundle->ebook_id;
            $harga = $bundle->price;
            $hargaAwal = $harga;
            if ($harga != 0) {
                $price = $harga * 1.11 + 5000;
            }
        }

        // devinisi
        $diskonRate = $request->input('diskon');
        $validDiskon = DiskonKelas::where('rate_diskon', $diskonRate)->first();

        // Validasi Diskon
        if ($validDiskon) {
            $diskon = ($diskonRate / 100) * $price;
            $potonganHarga = $price - $diskon;
            // Validasi apakah potongan harga sesuai
            if ($potonganHarga < 0) {
                return redirect()->back()->withErrors(['price' => 'Harga Tidak Valid'])->with('alert', ['type' => 'error', 'message' => 'Pembayaran Tidak Valid']);
            }
            // Update harga dengan harga setelah diskon
            $price = intval($potonganHarga);
        }

        // Periksa jika kursus gratis
        if ($price == 0) {
            $status = 'success';
        }



        // Cek apakah transaksi sudah ada dan pending
        $checkTransaction = Transaction::where('course_id', $courseId)
            ->where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();


        // array untuk simpan data transaksi dan list course
        $dataTransaction = [];
        $myListCourse = [];

        // perkondisian untuk mengatur setiap pembelian supaya tidak bug
        if ($courseId != null) {
            $dataTransaction = [
                'user_id' => $user->id,
                'transaction_code' => $transaction_code,
                'snap_token' => '',
                'course_id' => $courseId,
                'name' => $name,
                'price' => $price,
                'status' => $status,
            ];

            $myListCourse = [
                'user_id' => $user->id,
                'course_id' => $courseId,
            ];
        } else if ($ebookId != null) {
            $dataTransaction = [
                'user_id' => $user->id,
                'transaction_code' => $transaction_code,
                'snap_token' => '',
                'ebook_id' => $ebookId,
                'name' => $name,
                'price' => $price,
                'status' => $status,
            ];

            $myListCourse = [
                'user_id' => $user->id,
                'ebook_id' => $ebookId,
            ];
        } else if ($bundleId != null) {
            $dataTransaction = [
                'user_id' => $user->id,
                'transaction_code' => $transaction_code,
                'snap_token' => '',
                'bundle_id' => $bundleId,
                'name' => $name,
                'price' => $price,
                'status' => $status,
            ];

            $myListCourse = [
                'user_id' => $user->id,
                'course_id' => $courseId,
                'ebook_id' => $ebookId,
            ];
        }

        if (!isset($checkTransaction)) {
            if ($status == 'success') {

                Transaction::create($dataTransaction);

                // jika bundle maka otomatis mengisi ebook_id dan course_id sesuai dengan nilai dari tbl_course_ebook
                MyListCourse::create($myListCourse);

                DetailTransactions::create([
                    'transaction_code' => $transaction_code,
                    'name_item' => $dataTransaction['name'],
                    'harga_awal' => $hargaAwal,
                    'promo' => $diskon,
                    'total_harga' => intval($price),
                ]);

                if ($course) {
                    return redirect()->route('member.course.join', $course->slug)->with('alert', ['type' => 'success', 'message' => 'Kelas Berhasil Dibeli']);
                } elseif ($ebook) {
                    return redirect()->route('member.ebook.join', $ebook->slug)->with('alert', ['type' => 'success', 'message' => 'Kelas Berhasil Dibeli']);
                } elseif ($bundle) {
                    return redirect()->route('member.course.join', $bundle->course->slug)->with('alert', ['type' => 'success', 'message' => 'Kelas Berhasil Dibeli']);
                }
            } else {
                // Lakukan pemrosesan Midtrans jika belum sukses
                \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
                \Midtrans\Config::$isProduction = env('MIDTRANS_PRODUCTION');
                \Midtrans\Config::$isSanitized = true;
                \Midtrans\Config::$is3ds = true;

                $params = [
                    'transaction_details' => [
                        'order_id' => $transaction_code,
                        'gross_amount' => intval($price),
                    ],
                    'customer_details' => [
                        'name' => $user->name,
                        'email' => $user->email,
                    ],
                    'enabled_payments' => [
                        'bank_transfer',
                        'va_bank',
                        'qris',
                        'gopay',
                        'shopeepay'
                    ],
                    'callbacks' => [
                        'finish' => route('member.transaction'),
                        'error' => route('member.transaction'),
                    ],
                ];

                // dd([
                //     'name_item' => $dataTransaction['name'],
                //     'harga_awal' => $hargaAwal,
                //     'promo' => $diskon,
                //     'total_harga' => intval($price),
                // ]);

                DetailTransactions::create([
                    'transaction_code' => $transaction_code,
                    'name_item' => $dataTransaction['name'],
                    'harga_awal' => $hargaAwal,
                    'promo' => $diskon,
                    'total_harga' => intval($price),
                ]);

                $createdTransactionMidtrans = \Midtrans\Snap::createTransaction($params);
                $midtransRedirectUrl = $createdTransactionMidtrans->redirect_url;

                $dataTransaction['snap_token'] = $createdTransactionMidtrans->token;
                Transaction::create($dataTransaction);
                return redirect($midtransRedirectUrl);
            }
        } else {
            if ($status == 'success') {

                Transaction::create($dataTransaction);

                // jika bundle maka otomatis mengisi ebook_id dan course_id sesuai dengan nilai dari tbl_course_ebook
                MyListCourse::create($myListCourse);

                DetailTransactions::create([
                    'transaction_code' => $transaction_code,
                    'name_item' => $dataTransaction['name'],
                    'harga_awal' => $hargaAwal,
                    'promo' => $diskon,
                    'total_harga' => intval($price),
                ]);

                if ($course) {
                    return redirect()->route('member.course.join', $course->slug)->with('alert', ['type' => 'success', 'message' => 'Kelas Berhasil Dibeli']);
                } elseif ($ebook) {
                    return redirect()->route('member.ebook.join', $ebook->slug)->with('alert', ['type' => 'success', 'message' => 'Kelas Berhasil Dibeli']);
                } elseif ($bundle) {
                    return redirect()->route('member.course.join', $bundle->course->slug)->with('alert', ['type' => 'success', 'message' => 'Kelas Berhasil Dibeli']);
                }
            } else {
                $url = env('MIDTRANS_PRODUCTION')
                    ? "https://app.midtrans.com/snap/v4/redirection/{$checkTransaction->snap_token}"
                    : "https://app.sandbox.midtrans.com/snap/v4/redirection/{$checkTransaction->snap_token}";

                return redirect($url);
            }
            // Redirect ke transaksi pending sebelumnya jika ada
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

                if ($transaction->course_id != null) {
                    MyListCourse::create([
                        'user_id' => $transaction->user_id,
                        'course_id' => $transaction->course_id, // Pastikan ini valid
                    ]);
                } elseif ($transaction->ebook_id != null) {
                    MyListCourse::create([
                        'user_id' => $transaction->user_id,
                        'ebook_id' => $transaction->ebook_id, // Pastikan ini valid
                    ]);
                } elseif ($transaction->bundle_id != null) {
                    $bundle = CourseEbook::whereIn('course_id', $transaction->bundle_id)->first();
                    MyListCourse::create([
                        'user_id' => $transaction->user_id,
                        'course_id' => $bundle->course_id, // Pastikan ini valid
                        'ebook_id' => $bundle->ebook_id, // Pastikan ini valid
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Failed to create MyListCourse: ' . $e->getMessage());
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
}
