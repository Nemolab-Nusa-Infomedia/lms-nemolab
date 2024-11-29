<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Menjadwalkan perintah untuk memperbarui status transaksi setiap menit
        $schedule->command('update:transaction-status')->everyMinute();
        // Menjadwalkan perintah untuk menghapus pengguna yang belum terverifikasi setiap hari
        $schedule->command('update:delete-users-verif')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
