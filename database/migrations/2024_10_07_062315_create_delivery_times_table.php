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
        Schema::create('delivery_times', function (Blueprint $table) {
            $table->id(); // 自動インクリメントのIDカラム
            $table->unsignedBigInteger('curriculums_id'); // カリキュラムID
            $table->dateTime('delivery_from'); // 公開開始日
            $table->dateTime('delivery_to'); // 公開終了日
            $table->timestamps(); // created_at と updated_at

            // 外部キー制約の設定 carriclumsのidが削除された場合連動削除する指示
            $table->foreign('curriculums_id')->references('id')->on('curriculums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_times');
    }
};
