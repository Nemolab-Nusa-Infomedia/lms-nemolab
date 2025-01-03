<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use RealRashid\SweetAlert\Facades\Alert;

// member routes
use App\Http\Controllers\Member\Auth\MemberLoginController;
use App\Http\Controllers\Member\Auth\MemberRegisterController;
use App\Http\Controllers\Member\Auth\ResendEmailVerif as MemberResendEmailController;
use App\Http\Controllers\Member\Auth\VerifpassController;
use App\Http\Controllers\Member\Auth\forgotPassController as MemberForgotPassController;
use App\Http\Controllers\Member\Dashboard\MemberSettingController;
use App\Http\Controllers\Member\LandingpageController as MemberLandingPagesController;
use App\Http\Controllers\Member\Dashboard\MemberMyCourseController;
use App\Http\Controllers\Member\MemberPaymentController;
use App\Http\Controllers\Member\MemberTransactionController;
use App\Http\Controllers\Member\MemberReviewController;
use App\Http\Controllers\Member\MemberEbookController;
use App\Http\Controllers\Member\MemberCourseController;

// admin routes
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminToolsController;
use App\Http\Controllers\Admin\AdminChapterController;
use App\Http\Controllers\Admin\AdminLessonController;
use App\Http\Controllers\Admin\AdminEbookController;
use App\Http\Controllers\Admin\AdminCourseEbookController;
use App\Http\Controllers\Admin\AdminDiskonController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminSuperadminController;
use App\Http\Controllers\Admin\AdminSubmissionController;
use App\Http\Controllers\Admin\AdminMentorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// route mainetanance
Route::get('/maintenance', function () {
    if (config('app.maintenance_mode') === true) {
        return view('error.maintenance'); // Menampilkan view 'pages/maintenance.blade.php'
    } else {
        return redirect()->route('home');
    }
})->name('pages.maintenance');


// menampilkan halaman maintenance jika website sedang dalam pengembangan (jika ingin mengaktifkan tinggal costum boolean true di env maintenance_mode)
Route::middleware('maintenance.middleware')->group(function () {

    Route::get('/', [MemberLandingPagesController::class, 'index'])->name('home');
    Route::view('/eror/pages', 'error.page404')->name('pages.error')->middleware('cache.headers:public;max_age=31536000;etag');

    Route::prefix('member')->group(function () {

        // member course
        Route::prefix('course')->group(function () {
            Route::get('/', [MemberCourseController::class, 'index'])->name('member.course');
            Route::get('join/{slug}', [MemberCourseController::class, 'join'])->name('member.course.join')->middleware(['students', 'verified']);
            Route::get('{slug}/play/episode/{episode}', [MemberCourseController::class, 'play'])->name('member.course.play')->middleware(['students', 'verified']);
            Route::get('detail/{slug}', [MemberCourseController::class, 'detail'])->name('member.course.detail')->middleware(['students', 'verified']);
            Route::get('detail/sertifikat/{slug}', [MemberCourseController::class, 'generateSertifikat'])->name('member.sertifikat')->middleware(['students', 'verified']);
        });
        Route::prefix('review')->middleware(['students', 'verified'])->group(function () {
            Route::get('{slug}', [MemberReviewController::class, 'index'])->name('member.review');
            Route::post('store', [MemberReviewController::class, 'store'])->name('member.review.store');
            Route::get('ebook/{slug}', [MemberReviewController::class, 'ebookFormReview'])->name('member.review.ebook');
            Route::post('ebook/store', [MemberReviewController::class, 'storeReviewEbook'])->name('member.review.ebook.store');
        });

        Route::prefix('payment')->middleware(['students', 'verified'])->group(function () {
            Route::get('payment/', [MemberPaymentController::class, 'index'])->name('member.payment');
            Route::post('payment/store', [MemberPaymentController::class, 'store'])->name('member.transaction.store');
        });

        Route::prefix('ebook')->middleware(['students', 'verified'])->group(function () {
            Route::get('{slug}', [MemberEbookController::class, 'index'])->name('member.ebook.join');
            Route::get('read/{slug}', [MemberEbookController::class, 'read'])->name('member.ebook.read');
            Route::get('detail/{slug}', [MemberEbookController::class, 'detail'])->name('member.ebook.detail');
        });

        // dashboard mycourse
        Route::get('/', [MemberMyCourseController::class, 'index'])->name('member.dashboard')->middleware(['students', 'verified']);
        // dashboard setting member
        Route::prefix('setting')->middleware(['students', 'verified'])->group(function () {
            Route::view('/', 'member.dashboard.setting.view')->name('member.setting');

            Route::view('profile', 'member.dashboard.setting.edit-profile')->name('member.setting.profile');
            Route::put('profile/updated', [MemberSettingController::class, 'updateProfile'])->name('member.setting.profile.updated');

            Route::view('change-email', 'member.dashboard.setting.edit-email')->name('member.setting.change-email');
            Route::put('change-email/updated', [MemberSettingController::class, 'updateEmail'])->name('member.setting.change-email.updated');

            Route::view('verifikasi-password', 'member.dashboard.setting.verifikasi-password')->name('member.setting.verifikasi-password');

            Route::view('reset-password', 'member.dashboard.setting.edit-password')->name('member.setting.reset-password');
            Route::put('reset-password/updated', [MemberSettingController::class, 'updatePassword'])->name('member.setting.reset-password.updated');
        });

        // My transaction
        Route::prefix('transaction')->middleware(['students', 'verified'])->group(function () {
            Route::get('/', [MemberTransactionController::class, 'index'])->name('member.transaction');
            Route::delete('/cancel/{id}', [MemberTransactionController::class, 'cancel'])->name('member.transaction.cancel');
            Route::get('/detail/{transaction_code}', [MemberTransactionController::class, 'show'])->name('member.transaction.view-transaction');
        });

        Route::view('login', 'member.auth.login')->name('member.login');
        Route::post('login/auth', [MemberLoginController::class, 'login'])->name('member.login.auth');

        Route::view('register', 'member.auth.register')->name('member.register');
        Route::post('register/store', [MemberRegisterController::class, 'store'])->name('member.register.store');

        // logout
        Route::get('user/logout', [MemberLoginController::class, 'logout'])->name('member.logout');

        Route::post('/setting/verifikasi-password', [VerifpassController::class, 'resend'])->name('verification-repass');
        Route::put('/setting/verify-pin', [VerifpassController::class, 'verifyPin'])->name('verification.verify-pass');

        // route halaman send verified
        Route::get('email/verify', [MemberResendEmailController::class, 'index'])->middleware('students')->name('verification.notice');

        // resend email verified
        Route::post('email/verification-notification', [MemberResendEmailController::class, 'resend'])->middleware(['students', 'throttle:custom-limit'])->name('verification.send');

        // handler email verified
        Route::get('email/verify/{id}/{hash}', [MemberResendEmailController::class, 'handler'])->middleware(['students', 'signed'])->name('verification.verify');

        // route halaman send reset oassword
        Route::get('forget-password', [MemberForgotPassController::class, 'index'])->name('member.forget-password');

        Route::post('forget-password/check', [MemberForgotPassController::class, 'checkEmail'])->middleware(['throttle:custom-limit-reset-pw'])->name('member.forget-password.check');

        // kirim link reset password
        Route::get('/reset-password/{token}', [MemberForgotPassController::class, 'sendResetLinkPassword'])->name('password.reset');
        Route::post('/reset-password/updated', [MemberForgotPassController::class, 'resetPassword'])->name('member.reset-password.updated');

        Route::post('/email/verify-pin', [MemberResendEmailController::class, 'verifyPin'])
            ->middleware(['auth', 'throttle:6,1'])
            ->name('verification.verify-pin');
    });


    Route::prefix('admin')->group(function () {
        Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('login/auth', [AdminLoginController::class, 'login'])->name('admin.login.auth');
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        // kelolah pengguna nemolab
        Route::prefix('data-users')->middleware(['superadmin', 'verified'])->group(function () {
            Route::prefix('student')->group(function () {
                Route::get('/', [AdminStudentController::class, 'index'])->name('admin.student');
                Route::get('/create', [AdminStudentController::class, 'create'])->name('admin.student.create');
                Route::post('/create/store', [AdminStudentController::class, 'store'])->name('admin.student.store');
                Route::get('/edit/', [AdminStudentController::class, 'edit'])->name('admin.student.edit');
                Route::put('/edit/update/{id}', [AdminStudentController::class, 'update'])->name('admin.student.update');
                Route::get('/delete/', [AdminStudentController::class, 'delete'])->name('admin.student.delete');
            });

            Route::prefix('mentor')->group(function () {
                Route::get('/', [AdminMentorController::class, 'index'])->name('admin.mentor');
                Route::get('/create', [AdminMentorController::class, 'create'])->name('admin.mentor.create');
                Route::post('/create/store', [AdminMentorController::class, 'store'])->name('admin.mentor.store');
                Route::get('/edit/', [AdminMentorController::class, 'edit'])->name('admin.mentor.edit');
                Route::put('/edit/update/{id}', [AdminMentorController::class, 'update'])->name('admin.mentor.update');
                Route::get('/delete/', [AdminMentorController::class, 'delete'])->name('admin.mentor.delete');
            });

            Route::prefix('superadmin')->group(function () {
                Route::get('/', [AdminSuperadminController::class, 'index'])->name('admin.superadmin');
                Route::get('/create', [AdminSuperadminController::class, 'create'])->name('admin.superadmin.create');
                Route::post('/create/store', [AdminSuperadminController::class, 'store'])->name('admin.superadmin.store');
                Route::get('/edit/', [AdminSuperadminController::class, 'edit'])->name('admin.superadmin.edit');
                Route::put('/edit/update/{id}', [AdminSuperadminController::class, 'update'])->name('admin.superadmin.update');
                Route::get('/delete/', [AdminSuperadminController::class, 'destroy'])->name('admin.superadmin.destroy');
            });

            Route::prefix('submission')->middleware('superadmin')->group(function () {
                Route::get('/', [AdminSubmissionController::class, 'index'])->name('admin.submissions');
                Route::put('/edit/update/{id}', [AdminSubmissionController::class, 'update'])->name('admin.submissions.edit.update');
                Route::get('/delete/{id}', [AdminSubmissionController::class, 'delete'])->name('admin.submissions.delete');
            });
        });

        // mentor course
        Route::prefix('course')->middleware(['mentor', 'verified'])->group(function () {
            Route::get('/', [AdminCourseController::class, 'index'])->name('admin.course');

            Route::get('/create', [AdminCourseController::class, 'create'])->name('admin.course.create');
            Route::post('/create/store', [AdminCourseController::class, 'store'])->name('admin.course.create.store');
            Route::get('/edit/', [AdminCourseController::class, 'edit'])->name('admin.course.edit');
            Route::put('/edit/update/{id}', [AdminCourseController::class, 'update'])->name('admin.course.edit.update');
            Route::get('/delete/', [AdminCourseController::class, 'delete'])->name('admin.course.delete');

            // chapters
            Route::get('{slug_course}/chapters', [AdminChapterController::class, 'index'])->name('admin.chapter');
            Route::get('{slug_course}/chapters/create', [AdminChapterController::class, 'create'])->name('admin.chapter.create');
            Route::post('{slug_course}/chapters/create/store', [AdminChapterController::class, 'store'])->name('admin.chapter.create.store');
            Route::get('{slug_course}/chapters/edit/', [AdminChapterController::class, 'edit'])->name('admin.chapter.edit');
            Route::put('{slug_course}/chapters/edit/update/{id_chapter}', [AdminChapterController::class, 'update'])->name('admin.chapter.edit.update');
            Route::get('chapters/delete/', [AdminChapterController::class, 'delete'])->name('admin.chapter.delete');

            // lesson
            Route::get('{slug_course}/chapter/{id_chapter}/lesson', [AdminLessonController::class, 'index'])->name('admin.lesson');
            Route::get('{slug_course}/chapter/{id_chapter}/lesson/create', [AdminLessonController::class, 'create'])->name('admin.lesson.create');
            Route::post('chapter/{id_chapter}/lesson/create/store', [AdminLessonController::class, 'store'])->name('admin.lesson.create.store');
            Route::get('{slug_course}/chapter/{id_chapter}/lesson/edit/', [AdminLessonController::class, 'edit'])->name('admin.lesson.edit');
            Route::put('chapter/lesson/edit/update/{id_lesson}', [AdminLessonController::class, 'update'])->name('admin.lesson.edit.update');
            Route::get('chapter/lesson/delete/', [AdminLessonController::class, 'delete'])->name('admin.lesson.delete');
        });

        Route::prefix('ebooks')->middleware(['mentor', 'verified'])->group(function () {
            Route::get('/', [AdminEbookController::class, 'index'])->name('admin.ebook');
            Route::get('/create', [AdminEbookController::class, 'create'])->name('admin.ebook.create');
            Route::post('/store', [AdminEbookController::class, 'store'])->name('admin.ebook.create.store');
            Route::get('/edit/', [AdminEbookController::class, 'edit'])->name('admin.ebook.edit');
            Route::put('/update/{ebook}', [AdminEbookController::class, 'update'])->name('admin.ebook.edit.update');
            Route::get('/delete/', [AdminEbookController::class, 'delete'])->name('admin.ebook.delete');
        });

        Route::prefix('paket-kelas')->middleware(['mentor', 'verified'])->group(function () {
            Route::get('/', [AdminCourseEbookController::class, 'index'])->name('admin.paket-kelas');
            Route::get('/create', [AdminCourseEbookController::class, 'create'])->name('admin.paket-kelas.create');
            Route::post('/store', [AdminCourseEbookController::class, 'store'])->name('admin.paket-kelas.create.store');
            Route::get('/edit/', [AdminCourseEbookController::class, 'edit'])->name('admin.paket-kelas.edit');
            Route::put('/update/{id_paket}', [AdminCourseEbookController::class, 'update'])->name('admin.paket-kelas.edit.update');
            Route::get('/delete/', [AdminCourseEbookController::class, 'delete'])->name('admin.paket-kelas.delete');
        });

        Route::prefix('tools')->middleware(['mentor', 'verified'])->group(function () {
            Route::get('/', [AdminToolsController::class, 'index'])->name('admin.tools');
            Route::get('/create', [AdminToolsController::class, 'create'])->name('admin.tools.create');
            Route::post('/create/store', [AdminToolsController::class, 'store'])->name('admin.tools.create.store');
            Route::get('/edit/{id}', [AdminToolsController::class, 'edit'])->name('admin.tools.edit');
            Route::put('/edit/update/{id}', [AdminToolsController::class, 'update'])->name('admin.tools.edit.update');
            Route::get('/delete/{id}', [AdminToolsController::class, 'delete'])->name('admin.tools.delete');
        });

        Route::prefix('diskon-kelas')->middleware(['mentor', 'verified'])->group(function () {
            Route::get('/', [AdminDiskonController::class, 'index'])->name('admin.diskon-kelas');
            Route::get('/create', [AdminDiskonController::class, 'create'])->name('admin.diskon-kelas.create');
            Route::post('/store', [AdminDiskonController::class, 'store'])->name('admin.diskon-kelas.create.store');
            Route::get('/edit/', [AdminDiskonController::class, 'edit'])->name('admin.diskon-kelas.edit');
            Route::put('/update/{id_diskon}', [AdminDiskonController::class, 'update'])->name('admin.diskon-kelas.edit.update');
            Route::get('/delete/', [AdminDiskonController::class, 'delete'])->name('admin.diskon-kelas.delete');
        });

        Route::prefix('kirim-pengajuan')->middleware(['superadmin', 'verified'])->group(function () {
            Route::get('users', [AdminSubmissionController::class, 'index'])->name('admin.pengajuan');
            Route::post('store/{id}', [AdminSubmissionController::class, 'store'])->name('admin.pengajuan.store');
        });
    });
});
