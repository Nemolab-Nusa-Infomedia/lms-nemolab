<?php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\CustomVerifyEmailNotification;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    //menggunakan Facktor agar dapat digunakan dengan seeder
    use HasApiTokens, HasFactory, Notifiable;

    //memmeriksa agar hanya kolom tersebut yang boleh disi
    protected $fillable = [
        'avatar',
        'name',
        'email',
        'password',
        'profession',
        'role',
        'verification_pin',
        'pin_expires_at',
    ];

    //agar kolom dibawah ini tidak berubah
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relasi ke model Course.
     * Seorang user dapat berelasi denga banyak course
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'mentor_id', 'id');
    }

    /**
     * Seorang user dapat berelasi dengan banyak transaksi
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }
    /**
     * Seorang user dapat berelasi dengan banyak transaksi
     */
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

}
