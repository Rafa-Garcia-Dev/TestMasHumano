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
        Schema::create('rgreserve', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idRoom');
            $table->foreign('idRoom')->references('id')->on('rgroom');
            $table->integer('daysNumber');
            $table->date('startDate');
            $table->date('endDate');
            $table->unsignedBigInteger('idClient');
            $table->foreign('idClient')->references('id')->on('rgclient');
            $table->unsignedBigInteger('idState');
            $table->foreign('idState')->references('id')->on('rgstate');
            $table->unsignedBigInteger('idEmployee');
            $table->foreign('idEmployee')->references('id')->on('rgemployee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reserve');
    }
};
