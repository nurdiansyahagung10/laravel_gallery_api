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
        Schema::create('likefoto', function (Blueprint $table) {
            $table->id('likeid');
            $table->unsignedBigInteger('fotoid');
            $table->unsignedBigInteger('userid');
            $table->date('tanggallike')->default(date('Y-m-d'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likefoto');
    }
};
