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
            $table->string('id',36)->unique();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('created_by',36)->comment('建立人員');
            $table->timestamp('created_at')->comment('建立時間');
            $table->string('updated_by',36)->comment('更新人員');
            $table->timestamp('updated_at')->comment('更新時間');
            $table->softDeletes()->comment('資料狀態');
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
