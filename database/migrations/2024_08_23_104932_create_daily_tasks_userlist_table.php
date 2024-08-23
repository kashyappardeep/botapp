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
        Schema::create('daily_tasks_userlist', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('daily_task_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 15, 2);
            $table->string('link');
            $table->string('type')->default(1)->comment('1=>Facebook ,2=>Youtube');
            $table->string('status')->default(1)->comment('1=>pending ,2=> Complete ,3 => Reject,');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_tasks_userlist');
    }
};
