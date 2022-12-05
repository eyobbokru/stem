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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->references('id')->on('courses')->constrained()->cascadeOnDelete();
            $table->foreignId('group_id')->references('id')->on('groups')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->references('id')->on('students')->constrained()->cascadeOnDelete();
            $table->foreignId('academic_session_id')->references('id')->on('academic_sessions')->constrained()->cascadeOnDelete();
            $table->integer("score")->nullable();
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
        Schema::dropIfExists('grades');
    }
};
