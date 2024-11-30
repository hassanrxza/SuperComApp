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
        Schema::create('project', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id')->primary()->unique();
            $table->string('repoID');
            $table->foreign('repoID')->references('id')->on('repositories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('title');
            $table->text('description');
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('medium');
            $table->text('contrib_guidelines')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project');
    }
};
