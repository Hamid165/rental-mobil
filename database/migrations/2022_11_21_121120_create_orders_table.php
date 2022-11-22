<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mobil_id');
            $table->foreignId('user_id');
            $table->string('nama_tempat');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->date('tanggal_ambil');
            $table->date('tanggal_kembali');
            $table->date('waktu_ambil');
            $table->date('waktu_kembali');
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
        Schema::dropIfExists('orders');
    }
};
