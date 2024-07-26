<?php

use App\Http\Controllers\Api\CourseApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\Api\CourseApiControlleri;
=======
use App\Http\Controllers\Admin\AdminChapterController;
use App\Http\Controllers\Admin\AdminLessonController;
use App\Http\Controllers\Admin\AdminToolsController;
use App\Http\Controllers\Admin\AdminCourseController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminReviewController; 
>>>>>>> 4a239a28d8c10199501dd0bf6ea594224a8c0030

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

<<<<<<< HEAD
// Route::prefix('course')->group(function() {
// });
Route::get('v1/course/', [CourseApiController::class, 'course'])->name('api.course.query');
Route::get('v1/course/chapter/', [CourseApiController::class, 'chapter'])->name('api.course.chapter');
=======
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->group(function() {

    // routes tools
    Route::prefix('tools')->group(function() {
        Route::get('/', [AdminToolsController::class, 'index'])->name('admin.tools');
        Route::get('/create', [AdminToolsController::class, 'create'])->name('admin.tools.create');
        Route::post('/create/store', [AdminToolsController::class, 'store'])->name('admin.tools.create.store');
        Route::put('/edit/update/{id}', [AdminToolsController::class, 'update'])->name('admin.tools.edit.update');
        Route::get('/delete/{id}', [AdminToolsController::class, 'delete'])->name('admin.tools.delete');
    });
    
    // routes chapter
    Route::prefix('chapter')->group(function() {
        Route::get('/', [AdminChapterController::class, 'index'])->name('admin.chapter');
        Route::get('/create', [AdminChapterController::class, 'create'])->name('admin.chapter.create');
        Route::post('/create/store', [AdminChapterController::class, 'store'])->name('admin.chapter.create.store');
        Route::put('/edit/update/{id}', [AdminChapterController::class, 'update'])->name('admin.chapter.edit.update');
        Route::get('/delete/{id}', [AdminChapterController::class, 'delete'])->name('admin.chapter.delete');
    });
    
    // routes lesson
    Route::prefix('lesson')->group(function() {
        Route::get('/', [AdminLessonController::class, 'index'])->name('admin.lesson');
        Route::get('/create', [AdminLessonController::class, 'create'])->name('admin.lesson.create');
        Route::post('/create/store', [AdminLessonControLler::class, 'store'])->name('admin.lesson.create.store');
        Route::put('/edit/update/{id}', [AdminLessonController::class, 'update'])->name('admin.lesson.edit.update');
        Route::get('/delete/{id}', [AdminLessonController::class, 'delete'])->name('admin.chapter.delete');
    });

    // routes for course
    Route::prefix('course')->group(function() {
        Route::get('/', [AdminCourseController::class, 'index'])->name('admin.course.index');
        Route::post('/create/store', [AdminCourseController::class, 'store'])->name('admin.course.create.store');
        Route::put('/edit/update/{id}', [AdminCourseController::class, 'update'])->name('admin.course.edit.update');
        Route::get('/delete/{id}', [AdminCourseController::class, 'delete'])->name('admin.course.delete');
    });
    
    // routes for user
    Route::prefix('user')->group(function() {
        Route::get('/', [AdminUserController::class, 'index'])->name('admin.user.index');
        Route::get('/create', [AdminUserController::class, 'create'])->name('admin.user.create');
        Route::post('/store', [AdminUserController::class, 'store'])->name('admin.user.store');
        Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.user.edit');
        Route::put('/update/{id}', [AdminUserController::class, 'update'])->name('admin.user.update');
        Route::get('/delete/{id}', [AdminUserController::class, 'delete'])->name('admin.user.delete');
    });
    
    // routes for review
    Route::prefix('review')->group(function() {
        Route::get('/', [AdminReviewController::class, 'index'])->name('admin.review.index');
        Route::get('/create', [AdminReviewController::class, 'create'])->name('admin.review.create');
        Route::post('/store', [AdminReviewController::class, 'store'])->name('admin.review.store');
        Route::get('/edit/{id}', [AdminReviewController::class, 'edit'])->name('admin.review.edit');
        Route::put('/update/{id}', [AdminReviewController::class, 'update'])->name('admin.review.update');
        Route::get('/delete/{id}', [AdminReviewController::class, 'delete'])->name('admin.review.delete');
    });
});
>>>>>>> 4a239a28d8c10199501dd0bf6ea594224a8c0030
