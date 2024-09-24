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
        Schema::create('tbl_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('ebook_id')->nullable();
            $table->string('transaction_code')->nullable(false);
            $table->string('snap_token')->nullable(false);
            $table->string('name')->nullable(false);
            $table->integer('price')->nullable(false);
            $table->enum('status', ['success', 'pending', 'failed'])->default('pending');
            $table->timestamps();
            $table->foreign('course_id')->references('id')->on('tbl_courses')->onDelete('set null');
            $table->foreign('ebook_id')->references('id')->on('tbl_ebooks')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_transactions');
    }
};