<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('star_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stars_id');
            $table->integer('star_count');
            $table->foreign('stars_id')
                ->on('stars')
                ->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('star_counts');
    }
};
