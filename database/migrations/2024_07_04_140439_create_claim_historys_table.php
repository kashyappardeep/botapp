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
        Schema::create('claim_historys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to users table
            $table->unsignedBigInteger('telegram_id'); // Foreign key to users table
            $table->decimal('amount', 15, 2);
            $table->string('type')->default(1)->comment('1=>Daily Roi ,2=> referral_by');
            $table->string('claimed_at'); // Timestamp of when the claim was made
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claim_historys');
    }
};
