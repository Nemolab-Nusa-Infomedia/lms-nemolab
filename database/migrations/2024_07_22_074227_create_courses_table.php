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
        Schema::create('tbl_courses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('cover');
            $table->enum('type', ['free', 'premium']);
            $table->enum('status', ['draft', 'published']);
            $table->integer('price');
            $table->enum('level', ['beginner', 'intermediate', 'expert']);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('mentor_id');
            $table->timestamps();
            // Foreign key constraint (assuming 'users' table exists)
            $table->foreign('mentor_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

/**
 * Reverse the migrations.
 */
    public function down(): void
    {
        Schema::dropIfExists('tbl_courses');
    }

};
