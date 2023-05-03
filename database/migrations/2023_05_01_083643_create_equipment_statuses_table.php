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
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Schema::create('equipment_statuses', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('laboratory_equipment_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('laboratory_equipment_id')->references('id')->on('laboratory_equipment')->constrained()->cascadeOnDelete();
           
            $table->text('description');
            $table->string('number');
            $table->string('status');
            $table->timestamps();
        });
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_statuses');
    }
};
