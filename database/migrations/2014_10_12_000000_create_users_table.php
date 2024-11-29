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
            $table->text('avatar')->nullable(true);
            $table->string('email', 255)->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->nullable(false);
            $table->enum('profession', ['Pelajar Jangka Panjang', 'UI/UX Designer', 'Frontend Developer', 'Backend Developer', 'Wordpress Developer', 'Graphics Designer', 'Fullstack Developer'])->default('Pelajar Jangka Panjang');
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
