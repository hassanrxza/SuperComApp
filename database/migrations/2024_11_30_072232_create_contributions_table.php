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
        Schema::create('contributions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id')->primary()->unique();
            $table->string('projectID');
            $table->foreign('projectID')->references('id')->on('project')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('userID');
            $table->foreign('userID')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending'); // Request status
            $table->text('contribution_notes')->nullable(); // Notes or messages sent by the contributor
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributions');
    }
};
