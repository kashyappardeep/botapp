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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('telegram_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('referral_by')->nullable();
            $table->string('status')->default('1')->comment('1=>free Packeg ,2=> paid Packeg');
            $table->decimal('wallet', 8, 2)->default(0);
            $table->string('join_date');
            $table->timestamps(); // This adds `created_at` and `updated_at` columns

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
