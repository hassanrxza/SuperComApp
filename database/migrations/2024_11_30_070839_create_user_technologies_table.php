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
        Schema::create('user_technologies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id')->primary()->unique();
            $table->string('userID');
            $table->foreign('userID')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('technologyID');
            $table->foreign('technologyID')->references('id')->on('technologies')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_technologies');
    }
};