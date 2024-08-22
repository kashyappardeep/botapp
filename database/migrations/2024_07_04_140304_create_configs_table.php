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
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('daily_roi');
            $table->string('admin_wallet_address');
            $table->string('level_of_referral');
            $table->string('gateway_key')->nullable();
            $table->string('task_amount');
            $table->string('content_reward');
            $table->string('min_withdrawal');
            $table->string('min_investment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configs');
    }
};
