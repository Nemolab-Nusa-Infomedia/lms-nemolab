<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;

class DeleteUsersVerif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:delete-users-verif';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cek Akun Verif Realtime';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // ambil data user yang verif emailnya tidak ada
        $users = User::whereNull('email_verified_at')->get();

        // hapus user yang tidak ada verif email (email_verifed_at kosong)
        $users->each(function ($user) {
            $user->delete();
        });
    }
}
