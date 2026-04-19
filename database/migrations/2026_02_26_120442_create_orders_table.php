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
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('order_number')->unique();
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'canceled']);
            $table->integer('total_amount');
            $table->enum('discount_type', ['percent','cash'])->nullable();
            $table->integer('discount_amount')->default(0);
            $table->integer('extra_discount')->default(0);
            $table->integer('discount_coupon')->default(0);
            $table->integer('tax_amount');
            $table->integer('packing_cost')->default(0);
            $table->integer('shipping_cost')->default(0);
            $table->integer('final_amount');
            $table->enum('payment_status', ['unpaid', 'paid', 'failed']);
            $table->string('payment_method');
            $table->text('shipping_method');
            $table->text('shipping_province');
            $table->text('shipping_city');
            $table->bigInteger('shipping_postal_code');
            $table->text('shipping_address');
            $table->unsignedBigInteger('tracking_code')->nullable();
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
