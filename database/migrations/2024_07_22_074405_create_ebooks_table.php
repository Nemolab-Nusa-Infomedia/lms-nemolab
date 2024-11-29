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
            $table->unsignedBigInteger('mentor_id');
            $table->string('name', 255)->nullable(false);
            $table->string('slug')->unique();
            $table->text('cover')->nullable();
            $table->enum('type', ['free', 'premium']);
            $table->string('product_type')->default('ebook');
            $table->enum('category', ['Frontend Developer', 'Backend Developer', 'Wordpress Developer','Graphics Designer','Fullstack Developer','UI/UX Designer'])->default('Frontend Developer');
            $table->enum('status', ['draft', 'published']);
            $table->integer('price')->nullable();
            $table->enum('level', ['beginner', 'intermediate', 'expert']);
            $table->text('description', 255);
            $table->text('file_ebook')->nullable(false);
            // $table->text('rating')->nullable(true);
            $table->timestamps();
            // Change cascade to set null for course_id
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
