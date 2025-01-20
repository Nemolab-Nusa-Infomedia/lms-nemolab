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
        Schema::create('tbl_detail_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code', 255);
            $table->string('name_item', 255);
            $table->integer('harga_awal');
            $table->integer('promo')->nullable(true);
            $table->integer('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_detail_transactions');
    }
};
