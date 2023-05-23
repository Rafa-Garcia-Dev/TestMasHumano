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
        Schema::create('rgroom', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('idState');
            $table->foreign('idState')->references('id')->on('rgstate');
            $table->integer('capacity');
            $table->string('observation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room');
    }
};
