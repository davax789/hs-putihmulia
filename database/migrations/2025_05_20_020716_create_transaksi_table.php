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
        Schema::create('transaksi', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('kebangsaan');
            $table->string('kode_negara')->nullable();
            $table->string('nohp')->nullable();
            $table->string('noKamar');
            $table->string('kode_transaksi', 20)->unique();
            $table->integer('total_harga');
            $table->date('check_in');
            $table->date('check_out');
            $table->string('metode_pembayaran');
            $table->string('status')->default('pending');
            $table->dateTime('tanggal_transaksi')->nullable();
            $table->dateTime('tanggal_pembayaran')->nullable();
            $table->string('acceptedby')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('noKamar')->references('nomorkamar')->on('kamarDalam')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
