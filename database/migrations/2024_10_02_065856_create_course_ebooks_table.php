<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_course_ebooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->nullable()->constrained('tbl_courses')->onDelete('set null');
            $table->foreignId('ebook_id')->nullable()->constrained('tbl_ebooks')->onDelete('set null');
            $table->enum('type', ['free', 'premium']);
            // $table->enum('status', ['draft', 'published']);
            // $table->enum('category', ['Frontend Developer', 'Backend Developer', 'Wordpress Developer','Graphics Designer','Fullstack Developer','UI/UX Designer'])->default('Frontend Developer');
            $table->integer('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_course_ebooks');
    }
};
