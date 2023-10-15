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
            $table->string('id',36)->unique()->comment('user uuid');
            $table->string('name')->comment('名字');
            $table->string('email')->comment('email');
            $table->string('password')->comment('密碼');
            $table->string('created_by',36)->comment('建立人員');
            $table->dateTime('created_at')->comment('建立時間');
            $table->string('updated_by',36)->comment('更新人員');
            $table->dateTime('updated_at')->comment('更新時間');
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
