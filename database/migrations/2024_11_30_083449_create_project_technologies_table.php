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
        Schema::create('project_technologies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('id')->primary()->unique()->default(Str::random(10));
            $table->string('projectID');
            $table->foreign('projectID')->references('id')->on('project')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('technologyID')->constrained('technologies')
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
        Schema::dropIfExists('project_technologies');
    }
};
