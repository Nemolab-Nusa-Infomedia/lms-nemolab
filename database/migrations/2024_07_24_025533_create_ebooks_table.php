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
        Schema::create('tbl_ebooks', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->text('cover')->nullable();
            $table->string('name', 255)->nullable(false);
            $table->enum('type', ['free', 'premium']);
            $table->string('category', 255);
            $table->enum('status', ['draft', 'published']);
            $table->integer('price')->nullable();
            $table->text('description', 255); 
            $table->text('ebook')->nullable(false);
            $table->unsignedBigInteger('mentor_id');
            $table->timestamps();
            // Change cascade to set null for course_id
            $table->foreign('course_id')->references('id')->on('tbl_courses')->onDelete('set null');
            $table->foreign('mentor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ebooks');
    }
};
