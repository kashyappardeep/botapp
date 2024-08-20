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
            $table->string('address')->nullable();
            $table->string('status')->default(1)->comment('1=>pending ,2=> complete');

            $table->decimal('amount', 15, 2)->nullable();
            $table->string('level')->nullable();
            $table->string('type')->default(1)->comment('0=>claim ,1=>task ,2=> referral_by ,3 => withdraw');

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
