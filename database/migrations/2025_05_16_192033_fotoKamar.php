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
        Schema::create('fotoKamar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kamar_id'); // foreign key ke kamarDalam
            $table->string('photo_path');
            $table->timestamps();

            // foreign key constraint
            $table->foreign('kamar_id')->references('id')->on('kamarDalam')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotoKamar');

    }
};
