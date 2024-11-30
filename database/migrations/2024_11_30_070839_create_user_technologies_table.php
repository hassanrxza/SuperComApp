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
            $table->string('id')->primary()->unique();
            $table->foreign('userID')->references('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('technologyID')->references('technologies')
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
