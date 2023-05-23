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
        Schema::create('rgwaitingClient', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idRoom');
            $table->foreign('idRoom')->references('id')->on('rgroom');
            $table->date('startDate');
            $table->date('endDate');
            $table->unsignedBigInteger('idClient');
            $table->foreign('idClient')->references('id')->on('rgclient');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waiting_client');
    }
};
