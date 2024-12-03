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
        Schema::create('curriculums', function (Blueprint $table) {
            $table->id(); // IDカラム
            $table->string('title'); // カリキュラムタイトル
            $table->string('thumbnail'); // カリキュラムサムネイル
            $table->longText('description'); // カリキュラム説明文
            $table->mediumText('video_url'); // 動画URL
            $table->tinyInteger('alway_delivery_flg')->default(0); // 常時公開フラグ（デフォルトは0）
            $table->integer('grade_id'); // クラスID
            $table->timestamps(); // created_at と updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curriculums');
    }
};
