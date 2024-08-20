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
        Schema::create('content_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('telegram_id');
            $table->unsignedBigInteger('linkverify_id');
            $table->string('link');
            $table->string('status')->default(1)->comment('1=>pending ,2=> complete');
            $table->string('type')->default(1)->comment('1=>instagram ,2=> facebook');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_data');
    }
};
