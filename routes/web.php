<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminChapterController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminLessonController;
use App\Http\Controllers\Admin\AdminToolsController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Member\AdminSettingController;
use App\Http\Controllers\Admin\AdminEbookController;
use App\Http\Controllers\Admin\AdminForumController;
use App\Http\Controllers\Admin\AdminMentorController;
use App\Http\Controllers\Admin\AdminPortofolioController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminSuperadminController;
use App\Http\Controllers\Admin\AdminTransactionController;
use App\Http\Controllers\Admin\AdminSubmissionController;

use App\Http\Controllers\Member\Auth\MemberRegisterController;
use App\Http\Controllers\Member\Auth\MemberLoginController;
use App\Http\Controllers\Member\LandingpageController;
use App\Http\Controllers\Member\MemberCourseController;
use App\Http\Controllers\Member\MemberPaymentController;
use App\Http\Controllers\Member\MemberTransactionController;
use App\Http\Controllers\Member\MemberReviewController;
use App\Http\Controllers\Member\MemberSettingController;
use App\Http\Controllers\Member\Dashboard\MemberMyCourseController;
use App\Http\Controllers\Member\Dashboard\MemberPortofolioController;
use App\Http\Controllers\Member\MemberEbookController;
use App\Http\Controllers\Member\MemberCommentController;
use App\Http\Controllers\Member\MemberWebhookTransactionsController;

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

Route::middleware('maintenance.middleware')->group(function () {
    Route::get('/', [LandingpageController::class, 'index'])->name('home');

    // login member
    Route::get('/login', [MemberLoginController::class, 'index'])->name('member.login');
    Route::post('/login/auth', [MemberLoginController::class, 'login'])->name('member.login.auth');
    Route::get('/logout', [MemberLoginController::class, 'logout'])->name('member.logout');
    Route::get('/register', [MemberRegisterController::class, 'index'])->name('member.register');
    Route::post('/register/store', [MemberRegisterController::class, 'store'])->name('member.register.auth');

    // login admin
    Route::get('admin/login', [AdminLoginController::class, 'index'])->name('admin.login');
    Route::post('admin/login/auth', [AdminLoginController::class, 'login'])->name('admin.login.auth');
    Route::get('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    Route::prefix('admin')->group(function () {
        // Routes for tools
        Route::prefix('tools')
            ->middleware('mentor')
            ->group(function () {
                Route::get('/', [AdminToolsController::class, 'index'])->name('admin.tools');
                Route::get('/create', [AdminToolsController::class, 'create'])->name('admin.tools.create');
                Route::post('/create/store', [AdminToolsController::class, 'store'])->name('admin.tools.create.store');
                Route::get('/edit/{id}', [AdminToolsController::class, 'edit'])->name('admin.tools.edit');
                Route::put('/edit/update/{id}', [AdminToolsController::class, 'update'])->name('admin.tools.edit.update');
                Route::get('/delete/{id}', [AdminToolsController::class, 'delete'])->name('admin.tools.delete');
            });

        // Routes for courses
        Route::get('/', [AdminCourseController::class, 'index'])
            ->middleware('mentor')
            ->name('admin.course');
        Route::prefix('course')
            ->middleware('mentor')
            ->group(function () {
                Route::get('/create', [AdminCourseController::class, 'create'])->name('admin.course.create');
                Route::post('/create/store', [AdminCourseController::class, 'store'])->name('admin.course.create.store');
                Route::get('/edit/{id}', [AdminCourseController::class, 'edit'])->name('admin.course.edit');
                Route::put('/edit/update/{id}', [AdminCourseController::class, 'update'])->name('admin.course.edit.update');
                Route::get('/delete/{id}', [AdminCourseController::class, 'delete'])->name('admin.course.delete');

                // routes for Ebook
                // Route::prefix('ebook')->group(function () {
                //     Route::get('/', [AdminEbookController::class, 'index'])->name('admin.ebook');
                //     Route::get('/create', [AdminEbookController::class, 'create'])->name('admin.ebook.create');
                //     Route::post('/store', [AdminEbookController::class, 'store'])->name('admin.ebook.create.store');
                //     Route::get('/edit/{ebook}', [AdminEbookController::class, 'edit'])->name('admin.ebook.edit');
                //     Route::put('/update/{ebook}', [AdminEbookController::class, 'update'])->name('admin.ebook.edit.update');
                //     Route::get('/delete/{ebook}', [AdminEbookController::class, 'destroy'])->name('admin.ebook.delete');
                // });

                // Routes for chapters
                Route::get('{slug}/chapter', [AdminChapterController::class, 'index'])->name('admin.chapter');
                Route::get('{slug}/chapter/create/{id_course}', [AdminChapterController::class, 'create'])->name('admin.chapter.create');
                Route::post('chapter/create/store/{id_course}', [AdminChapterController::class, 'store'])->name('admin.chapter.create.store');
                Route::get('{slug}/chapter/edit/{id_chapter}', [AdminChapterController::class, 'edit'])->name('admin.chapter.edit');
                Route::put('chapter/edit/update/{id_chapter}', [AdminChapterController::class, 'update'])->name('admin.chapter.edit.update');
                Route::get('chapter/delete/{id_chapter}', [AdminChapterController::class, 'delete'])->name('admin.chapter.delete');
                Route::get('forum', [AdminForumController::class, 'index'])->name('admin.forum');
                // Route::get('/course/forum/{slug}', [AdminForumController::class, 'show'])->name('member.forum');

                // Routes for lessons
                Route::get('{slug}/chapter/{id_chapter}/lesson', [AdminLessonController::class, 'index'])->name('admin.lesson');
                Route::get('{slug}/chapter/{id_chapter}/lesson/create', [AdminLessonController::class, 'create'])->name('admin.lesson.create');
                Route::post('chapter/{id_chapter}/lesson/create/store', [AdminLessonController::class, 'store'])->name('admin.lesson.create.store');
                Route::get('{slug}/chapter/{id_chapter}/lesson/edit/{id_lesson}', [AdminLessonController::class, 'edit'])->name('admin.lesson.edit');
                Route::put('chapter/lesson/edit/update/{id_lesson}', [AdminLessonController::class, 'update'])->name('admin.lesson.edit.update');
                Route::get('chapter/lesson/delete/{id_lesson}', [AdminLessonController::class, 'delete'])->name('admin.lesson.delete');

                Route::prefix('transaction')->group(function () {
                    Route::get('/', [AdminTransactionController::class, 'index'])->name('admin.transaction');
                    Route::post('transactions/{id}/accept', [AdminTransactionController::class, 'accept'])->name('admin.transactions.accept');
                    Route::delete('transactions/{id}/cancel', [AdminTransactionController::class, 'cancel'])->name('admin.transactions.cancel');
                });
            });

        // setting admin
        // Route::prefix('setting')->group(function () {
        //     Route::get('/', [AdminSettingController, 'index'])->name('admin.setting');
        //     Route::get('/edit/profile/', [AdminSettingController::class, 'editProfile'])->name('admin.edit-profile');
        //     Route::put('/update/profile', [AdminSettingController::class, 'updateProfile'])->name('admin.update-profile');
        //     Route::get('/edit/password/', [AdminSettingController::class, 'editPassword'])->name('admin.edit-password');
        //     Route::post('/update/password', [AdminSettingController::class, 'updatePassword'])->name('admin.update-password');
        // });

        // Routes for users
        Route::prefix('user')
            ->middleware('superadmin')
            ->group(function () {
                Route::get('/', [AdminUserController::class, 'index'])->name('admin.user');
                Route::get('/create', [AdminUserController::class, 'create'])->name('admin.user.create');
                Route::post('/create/store', [AdminUserController::class, 'store'])->name('admin.user.create.store');
                Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.user.edit');
                Route::put('/edit/update/{id}', [AdminUserController::class, 'update'])->name('admin.user.edit.update');
                Route::get('/delete/{id}', [AdminUserController::class, 'delete'])->name('admin.user.delete');

                Route::prefix('member')
                    ->middleware('superadmin')
                    ->group(function () {
                        Route::get('/', [AdminStudentController::class, 'index'])->name('admin.member');
                        Route::get('/create', [AdminStudentController::class, 'create'])->name('admin.member.create');
                        Route::post('/create/store', [AdminStudentController::class, 'store'])->name('admin.member.store');
                        Route::get('/edit/{id}', [AdminStudentController::class, 'edit'])->name('admin.member.edit');
                        Route::put('/edit/update/{id}', [AdminStudentController::class, 'update'])->name('admin.member.update');
                        Route::get('/delete/{id}', [AdminStudentController::class, 'destroy'])->name('admin.member.destroy');
                    });

                Route::prefix('mentor')
                    ->middleware('superadmin')
                    ->group(function () {
                        Route::get('/', [AdminMentorController::class, 'index'])->name('admin.mentor');
                        Route::get('/create', [AdminMentorController::class, 'create'])->name('admin.mentor.create');
                        Route::post('/create/store', [AdminMentorController::class, 'store'])->name('admin.mentor.store');
                        Route::get('/edit/{id}', [AdminMentorController::class, 'edit'])->name('admin.mentor.edit');
                        Route::put('/edit/update/{id}', [AdminMentorController::class, 'update'])->name('admin.mentor.update');
                        Route::get('/delete/{id}', [AdminMentorController::class, 'destroy'])->name('admin.mentor.destroy');
                    });
                Route::prefix('superadmin')
                    ->middleware('superadmin')
                    ->group(function () {
                        Route::get('/', [AdminSuperadminController::class, 'index'])->name('admin.superadmin');
                        Route::get('/create', [AdminSuperadminController::class, 'create'])->name('admin.superadmin.create');
                        Route::post('/create/store', [AdminSuperadminController::class, 'store'])->name('admin.superadmin.store');
                        Route::get('/edit/{id}', [AdminSuperadminController::class, 'edit'])->name('admin.superadmin.edit');
                        Route::put('/edit/update/{id}', [AdminSuperadminController::class, 'update'])->name('admin.superadmin.update');
                        Route::get('/delete/{id}', [AdminSuperadminController::class, 'destroy'])->name('admin.superadmin.destroy');
                    });
            });

        // Routes for reviews
        // Route::prefix('review')->group(function () {
        //     Route::get('/', [AdminReviewController::class, 'index'])->name('admin.review');
        //     Route::get('/create', [AdminReviewController::class, 'create'])->name('admin.review.create');
        //     Route::post('/create/store', [AdminReviewController::class, 'store'])->name('admin.review.create.store');
        //     Route::get('/edit/{id}', [AdminReviewController::class, 'edit'])->name('admin.review.edit');
        //     Route::put('/edit/update/{id}', [AdminReviewController::class, 'update'])->name('admin.review.edit.update');
        //     Route::get('/delete/{id}', [AdminReviewController::class, 'delete'])->name('admin.review.delete');
        // });

        // Routes for categories
        Route::prefix('category')
            ->middleware('mentor')
            ->group(function () {
                Route::get('/', [AdminCategoryController::class, 'index'])->name('admin.category');
                Route::get('/create', [AdminCategoryController::class, 'create'])->name('admin.category.create');
                Route::post('/create/store', [AdminCategoryController::class, 'store'])->name('admin.category.create.store');
                Route::get('/edit/{id}', [AdminCategoryController::class, 'edit'])->name('admin.category.edit');
                Route::put('/edit/update/{id}', [AdminCategoryController::class, 'update'])->name('admin.category.edit.update');
                Route::get('/delete/{id}', [AdminCategoryController::class, 'delete'])->name('admin.category.delete');
            });

        // Routes for submissions
        Route::prefix('submission')
            ->middleware('superadmin')
            ->group(function () {
                Route::get('/', [AdminSubmissionController::class, 'index'])->name('admin.submissions');
                Route::put('/edit/update/{id}', [AdminSubmissionController::class, 'update'])->name('admin.submissions.edit.update');
                Route::get('/delete/{id}', [AdminSubmissionController::class, 'delete'])->name('admin.submissions.delete');
            });

        Route::prefix('portofolio')->group(function () {
            Route::get('/', [AdminPortofolioController::class, 'index'])->name('admin.portofolio');
            Route::put('/edit/update/{id}', [AdminPortofolioController::class, 'update'])->name('admin.portofolio.edit.update');
        });
    });

    Route::get('/course', [MemberCourseController::class, 'index'])->name('member.course');
    Route::get('/course/join/{slug}', [MemberCourseController::class, 'join'])->name('member.course.join');

    Route::prefix('member')
        ->middleware('student')
        ->group(function () {
            // pengajuan member
            Route::post('/request/mentor/{id}', [MemberMyCourseController::class, 'reqMentor'])->name('member.pengajuan');

            Route::get('/course/{slug}/play/episode/{episode}', [MemberCourseController::class, 'play'])->name('member.course.play');
            Route::get('/course/forum/{slug}', [MemberCommentController::class, 'index'])->name('member.forum');
            Route::get('/course/forum/{slug}/search', [MemberCommentController::class, 'search'])->name('member.forum.search');
            Route::post('/course/forum/{slug}/comment', [MemberCommentController::class, 'storeComment'])->name('member.forum.comment.store');
            Route::get('//forum/replies/{comment_id}', [MemberCommentController::class, 'getReplies'])->name('member.forum.replies');
            Route::post('/forum/reply/store', [MemberCommentController::class, 'storeReply'])->name('member.forum.reply.store');

            Route::prefix('review')->group(function () {
                Route::get('/', [MemberReviewController::class, 'index'])->name('member.reviews');
                Route::post('/store', [MemberReviewController::class, 'store'])->name('member.review.store');
                Route::get('/{id}', [MemberReviewController::class, 'show'])->name('member.reviews.show');
                Route::put('/{id}', [MemberReviewController::class, 'update'])->name('member.reviews.update');
                Route::delete('/{id}', [MemberReviewController::class, 'destroy'])->name('member.reviews.destroy');
            });

            // Dashboard
            Route::get('/', [MemberMyCourseController::class, 'index'])->name('member.dashboard');

            Route::prefix('portofolio')
                ->middleware('student')
                ->group(function () {
                    Route::get('/', [MemberPortofolioController::class, 'index'])->name('member.portofolio');
                    Route::get('/create', [MemberPortofolioController::class, 'create'])->name('member.portofolio.create');
                    Route::post('/create/store', [MemberPortofolioController::class, 'store'])->name('member.portofolio.create.store');
                    Route::get('/edit/{id}', [MemberPortofolioController::class, 'edit'])->name('member.portofolio.edit');
                    Route::put('/edit/update/{id}', [MemberPortofolioController::class, 'update'])->name('member.portofolio.edit.update');
                    Route::get('/delete/{id}', [MemberPortofolioController::class, 'delete'])->name('member.portofolio.delete');
                });

            Route::prefix('setting')->group(function () {
                Route::get('/', [MemberSettingController::class, 'index'])->name('member.setting');
                Route::get('/edit/profile/', [MemberSettingController::class, 'editProfile'])->name('member.edit-profile');
                Route::put('/update/profile', [MemberSettingController::class, 'updateProfile'])->name('member.update-profile');
                Route::get('/edit/password/', [MemberSettingController::class, 'editPassword'])->name('member.edit-password');
                Route::post('/update/password', [MemberSettingController::class, 'updatePassword'])->name('member.update-password');
            });

            Route::prefix('transaction')->group(function () {
                Route::get('/', [MemberTransactionController::class, 'index'])->name('member.transaction');
                Route::delete('/cancel/{id}', [MemberTransactionController::class, 'cancel'])->name('member.transaction.cancel');
            });

            Route::get('/paymentsuccess', function () {
                return view('member.payment-succes'); // Nama view yang ingin ditampilkan
            });

            Route::get('/detailpayment', function () {
                return view('member.dashboard.transaction.detail-payment'); // Nama view yang ingin ditampilkan
            });

            Route::get('course/payment', [MemberPaymentController::class, 'index'])->name('member.payment');
            Route::post('course/payment/store', [MemberPaymentController::class, 'store'])->name('member.transaction.store');

            Route::get('/transaction/view/{transaction_code}', [MemberPaymentController::class, 'viewTransaction'])->name('member.transaction.view');
            Route::get('/transaction/detail/{transaction_code}', [MemberPaymentController::class, 'detailTransaction'])->name('member.transaction.detail.view');
        });

    Route::view('/eror/pages', 'error.page404')->name('pages.error');
});

Route::view('/maintenance', 'error.maintenance')->name('pages.maintenance');
// Route::get('/test', [MemberPaymentController::class, 'test']);
