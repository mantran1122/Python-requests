<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('astrology_results', function (Blueprint $table) {
            $table->id(); // Khóa chính
            $table->foreignId('birth_info_id')->constrained()->onDelete('cascade'); // Liên kết với bảng birth_infos
            $table->string('zodiac'); // Cung hoàng đạo (vd: pisces)
            $table->text('result_json'); // Nội dung chiêm tinh (trả về từ API hoặc GPT)
            $table->enum('type', ['today', 'week', 'month', 'year', 'personality', 'ai_generated']); // Loại kết quả
            $table->timestamps(); // Tự động tạo created_at và updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('astrology_results');
    }
};
