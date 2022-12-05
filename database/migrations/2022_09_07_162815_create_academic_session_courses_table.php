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
        Schema::create('academic_session_courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('academic_session_id')->references('id')->on('academic_sessions')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->references('id')->on('courses')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('academic_session_courses');
    }
};
