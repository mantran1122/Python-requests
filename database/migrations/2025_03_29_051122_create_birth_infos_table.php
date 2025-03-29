<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('birth_infos', function (Blueprint $table) {
            $table->id(); // Khóa chính tự động tăng
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // Liên kết với bảng users (có thể null nếu không cần đăng nhập)
            $table->string('full_name'); // Họ tên người dùng
            $table->date('birth_date'); // Ngày sinh
            $table->time('birth_time')->nullable(); // Giờ sinh (tùy chọn)
            $table->enum('gender', ['male', 'female', 'other']); // Giới tính
            $table->string('birth_place'); // Nơi sinh
            $table->timestamps(); // Tự động tạo created_at và updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('birth_infos');
    }
};
