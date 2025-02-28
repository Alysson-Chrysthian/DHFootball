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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('avatar');
            $table->timestamp('birthday');
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('video_id');
            $table->foreign('position_id')
                ->references('id')
                ->on('positions');
            $table->foreign('video_id')
                ->references('id')
                ->on('videos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
