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
        Schema::create('RgDocTypes', function (Blueprint $table) {
            $table->id();
            $table->integer('value');
            $table->string('description');
            $table->unsignedBigInteger('idState');
            $table->foreign('idState')->references('id')->on('rgstate');
            $table->string('observation');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
