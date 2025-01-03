<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Support\Facades\Route;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        // Mendefinisikan rate limiter dengan custom response
        RateLimiter::for('custom-limit', function (Request $request) {
            $limit = Limit::perHour(5)->by($request->user()->id);

            return $limit->response(function () {
                // Mengarahkan ke halaman sebelumnya dengan pesan error jika limit tercapai

                Alert::error('Error', 'Anda telah mencapai batas pengiriman verifikasi. Silakan coba lagi setelah 1 jam.');
                return redirect()->back()->with(['status' => 'limit']);
            });
        });

        RateLimiter::for('custom-limit-reset-pw', function (Request $request) {
            $limit = Limit::perHour(5)->by($request->email);

            return $limit->response(function () {
                // Mengarahkan ke halaman sebelumnya dengan pesan error jika limit tercapai

                Alert::error('Error', 'Anda telah mencapai batas reset password. Silakan coba lagi setelah 1 jam.');
                return redirect()->back()->with(['statusSend' => 'limit']);
            });
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
