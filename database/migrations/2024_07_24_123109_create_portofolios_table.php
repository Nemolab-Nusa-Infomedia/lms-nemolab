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
        Schema::create('tbl_portofolio', function (Blueprint $table) {
            $table->id();
            $table->text('portofolio_name');
            $table->text('description')->nullable(true);
            $table->string('link_portofolio', 255)->nullable(true);
            $table->unsignedBigInteger('course_id');
            $table->timestamps();
            
            $table->foreign('course_id')->references('id')->on('tbl_courses')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_portofolio');
    }
};