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
        Schema::create('kamarDepan', function (Blueprint $table) {
    $table->id();
    $table->string('jenisKamar');
    $table->integer('hargaPermalam');
    $table->text('deskripsi');
    $table->string('photoKamar');
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamarDepan');
    }
};
