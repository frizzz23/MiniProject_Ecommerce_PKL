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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('addresses_id')->constrained('addresses');
            $table->foreignId('promo_code_id')->nullable()->constrained('promo_codes');
            $table->foreignId('postage_id')->constrained('postages');
            $table->decimal('sub_total_amount', 15, 2);
            $table->decimal('grand_total_amount', 15, 2);
            $table->enum('status_order', ['pending', 'processing', 'completed'])->default('pending');
            $table->string('snap_token')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
