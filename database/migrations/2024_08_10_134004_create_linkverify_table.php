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
        Schema::create('linkverify', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('status')->default(1)->comment('1=>Active ,2=> InActive');
            $table->string('type')->default(1)->comment('1=>instagram ,2=> facebook');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linkverify');
    }
};
