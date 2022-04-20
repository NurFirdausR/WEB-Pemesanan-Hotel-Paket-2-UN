<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKamarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kamar', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kamar');
            $table->string('no_kamar');
            $table->string('code_kamar');
            $table->integer('harga');
            $table->integer('maks_orang')->length(6);
            $table->unsignedBigInteger('fasilitas_id');
            $table->foreign('fasilitas_id')->references('id')->on('fasilitas');
            $table->unsignedBigInteger('tipe_kamar_id');
            $table->foreign('tipe_kamar_id')->references('id')->on('tipe_kamar');
            $table->enum('status', ['booked', 'unbooked','process']);
            $table->string('gambar');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kamar');
    }
}
