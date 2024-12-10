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
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->id();
            $table->decimal('discount_amount', 15, 2);
            $table->string('code')->unique();
            $table->integer('quantity'); // Kolom untuk menyimpan jumlah kode yang tersedia
            $table->decimal('minimum_purchase', 15, 2); // Kolom untuk menyimpan jumlah minimal pembelian
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promo_codes');
    }
};
