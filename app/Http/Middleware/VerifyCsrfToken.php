<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     * berguna untuk mencegah Cross Site Request
     * @var array<int, string>
     */
    protected $except = [
        'admin/tools',
        'admin/tools/create/store',
        'admin/tools/edit/update/*',
        'admin/tools/delete/*',
        'admin/chapter',
        'admin/chapter/create/store',
        'admin/chapter/edit/update/*',
        'admin/chapter/delete/*',
        'admin/lesson',
        'admin/lesson/create/store',
        'admin/lesson/edit/update/*',
        'admin/lesson/delete/*',
        'admin/course',
        'admin/course/create/store',
        'admin/course/edit/update/*',
        'admin/course/delete/*',
        'admin/user',
        'admin/user/create/store',
        'admin/user/store',
        'admin/user/edit/*',
        'admin/user/update/*',
        'admin/user/delete/*',
        'admin/review',
        'admin/review/create',
        'admin/review/store',
        'admin/review/edit/*',
        'admin/review/update/*',
        'admin/review/delete/*',
        'admin/category',
        'admin/category/create/store',
        'admin/category/edit/update/*',
        'admin/category/delete/*',
        'admin/submission',
        'admin/submission/create/store',
        'admin/submission/edit/update/*',
        'admin/submission/delete/*',
        // Member review routes
        'member/course/payment/store',
        'member/reviews',
        'member/reviews/*',
        'register/store'
    ];
}