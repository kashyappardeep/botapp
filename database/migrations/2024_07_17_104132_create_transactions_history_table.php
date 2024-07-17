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
        Schema::create('transactions_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('to')->nullable();
            $table->unsignedBigInteger('by')->nullable();
            $table->unsignedBigInteger('task_id')->nullable();
            $table->decimal('amount', 15, 2)->nullable();
            $table->string('level')->nullable();
            $table->string('type')->default(1)->comment('1=>task ,2=> referral_by');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions_history');
    }
};
