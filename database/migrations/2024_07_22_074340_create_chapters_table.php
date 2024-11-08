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
        Schema::create('tbl_chapters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable(false);
            
            // foreign key
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('tbl_courses');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_chapters');
    }
};