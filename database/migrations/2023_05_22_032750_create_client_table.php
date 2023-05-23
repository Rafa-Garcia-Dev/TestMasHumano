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
        Schema::create('rgclient', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastName');
            $table->unsignedBigInteger('idDocType');
            $table->foreign('idDocType')->references('id')->on('rgdoctypes');
            $table->string('docnumber')->unique();
            $table->string('email')->unique();
            $table->date('birthdate')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
