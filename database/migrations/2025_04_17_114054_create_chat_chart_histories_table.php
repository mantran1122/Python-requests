<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('chat_chart_histories', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id')->nullable(); // nếu có đăng nhập
        $table->text('user_message'); // người dùng hỏi gì
        $table->longText('ai_response')->nullable(); // AI trả lời gì
        $table->json('astro_data')->nullable(); // dữ liệu bản đồ sao (JSON)
        $table->string('chart_type')->default('western'); // hoặc 'vedic'
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_chart_histories');
    }
};
