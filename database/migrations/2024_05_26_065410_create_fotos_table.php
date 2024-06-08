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
        Schema::create('foto', function (Blueprint $table) {
            $table->id('fotoid');
            $table->string('judulfoto')->unique();
            $table->text('deskripsifoto')->nullable();
            $table->date('tanggalunggah')->default(date('Y-m-d'));
            $table->string('lokasifile');
            $table->unsignedBigInteger('albumid')->nullable();
            $table->unsignedBigInteger('userid');
            $table->foreign('userid')->references('userid')->on('users')->onDelete('cascade');
            $table->foreign('albumid')->references('albumid')->on('album')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto');
    }
};
