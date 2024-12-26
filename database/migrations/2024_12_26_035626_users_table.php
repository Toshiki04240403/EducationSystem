<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            
            $table->id();
            $table->string('name', 255)->nullable(false);
            $table->string('name_kana', 255)->nullable(false);
            $table->string('email', 255)->nullable(false);
            $table->string('password', 255)->nullable(false);
            $table->string('profile_image', 255)->nullable();
            $table->unsignedBigInteger('grade_id')->nullable(false);
            $table->timestamps();

            // 外部キー制約を追加
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            
        });
    }
};