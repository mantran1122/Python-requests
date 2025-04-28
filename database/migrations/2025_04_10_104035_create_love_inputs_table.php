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
        Schema::create('love_inputs', function (Blueprint $table) {
            $table->id();
            $table->string('person_a_name');
            $table->string('person_a_birthplace');
            $table->string('person_a_birthdate');
            $table->string('person_a_birthtime');
            $table->string('person_b_name');
            $table->string('person_b_birthplace');
            $table->string('person_b_birthdate');
            $table->string('person_b_birthtime');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('love_inputs');
    }
};
