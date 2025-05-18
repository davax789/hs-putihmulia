<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kamarDalam', function (Blueprint $table) {
            $table->id();
            $table->string('jenisKamar');
            $table->string('nomorKamar');
            $table->text('deskripsi');
            $table->string('status')->default('tersedia');
            $table->integer('hargaPermalam');
            $table->timestamps(); // created_at dan updated_at tidak nullable
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kamarDalam');
    }
};
