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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            $table->string('name', 255)->nullable(false);
            $table->string('username', 255)->nullable(false);
            // $table->string('re-password', 255)->nullable(false);
            $table->text('avatar')->nullable(true);
            $table->string('email', 255)->nullable(false);
            $table->string('password', 255)->nullable(false);
            // $table->enum('profession', ['mahasiswa', 'freelance'])->nullable(false);
            // $table->string('phone', 255)->nullable(false);
            // $table->string('city', 255)->nullable(false);
            // $table->string('national', 255)->nullable(false);
            $table->enum('role', ['students', 'mentor', 'superadmin'])->default('students');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};