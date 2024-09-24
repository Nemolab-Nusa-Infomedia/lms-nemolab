<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ebook extends Model
{
    use HasFactory;

    protected $table = 'tbl_ebooks';

    protected $fillable = [
        'course_id',
        'name',
        'type',
        'status',
        'price',
        'description',
        'ebook',
        'mentor_id',
        'slug'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ebook) {
            $ebook->slug = self::generateUniqueSlug($ebook->name);
        });

        static::updating(function ($ebook) {
            if ($ebook->isDirty('name')) {
                $ebook->slug = self::generateUniqueSlug($ebook->name);
            }
        });
    }

    public static function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $count = static::where('slug', 'LIKE', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
