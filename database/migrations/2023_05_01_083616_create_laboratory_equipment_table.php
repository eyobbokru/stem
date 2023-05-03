<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
        
        Schema::create('laboratory_equipment', function (Blueprint $table) {
            $table->id();
            $table->string('quantity');
            $table->string('number');
            // $table->foreignId('lab_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('lab_id')->references('id')->on('labs')->constrained()->cascadeOnDelete();
         
            // $table->foreignIdFor(\App\Models\Lab::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            // $table->foreignId('lab_equipment_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('lab_equipment_id')->references('id')->on('lab_equipment')->constrained()->cascadeOnDelete();
            
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
        Schema::dropIfExists('laboratory_equipment');
    }
};
