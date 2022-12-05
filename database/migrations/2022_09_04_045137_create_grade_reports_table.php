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
        Schema::create('grade_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->references('id')->on('students')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('grade_reports');
    }
};
