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
        Schema::create('investment_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('telegram_id')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('status')->default(1)->comment('1=>pending ,2=> complete');
            $table->string('type')->default(1)->comment('1=>Free ,2=> Paid');
            $table->string('tx_hash')->nullable();
            $table->foreignId('order_id')->nullable();
            $table->string('address')->nullable();
            $table->string('invest_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_history');
    }
};
