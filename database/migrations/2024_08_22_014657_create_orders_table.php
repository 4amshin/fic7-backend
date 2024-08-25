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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            // $table->bigInteger('user_id')->unsigned();
            // $table->bigInteger('seller_id')->unsigned();
            $table->string('order_code', 8)->unique();
            // $table->decimal('total_price', 15, 2);
            $table->unsignedBigInteger('total_price');
            $table->enum('payment_status', [1, 2, 3])->default(1)->comment('1=Waiting Payment, 2=Success, 3=Cancel/Error');
            $table->string('payment_url')->nullable();
            $table->text('delivery_address');
            $table->timestamps();

            // $table->foreign('user_id', 'userid_foreign')->reference('id')->on('users');
            // $table->foreign('seller_id', 'sellerid_foreign')->reference('id')->on('users');

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
