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
    Schema::create('zodiac_signs', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Tên cung
        $table->string('symbol')->nullable(); // Biểu tượng ♈
        $table->text('description')->nullable(); // Mô tả cung
        $table->date('start_date'); // Ngày bắt đầu
        $table->date('end_date');   // Ngày kết thúc
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zodiac_signs');
    }
};
