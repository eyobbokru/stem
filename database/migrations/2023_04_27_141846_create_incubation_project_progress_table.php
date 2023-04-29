<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incubation_project_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incubation_id')->references('id')->on('incubations')->constrained()->cascadeOnDelete();
            $table->longText('progressReport')->nullable();
            $table->string('image_video')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incubation_project_progress');
    }
};
