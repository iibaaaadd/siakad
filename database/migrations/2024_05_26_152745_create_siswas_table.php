<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nis')->unique();
            $table->string('foto');
            $table->string('tempat');
            $table->date('tgl');
            $table->string('alamat');
            $table->unsignedBigInteger('kelas_id');
            $table->string('email')->unique();
            $table->string('telepon')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P']); // 'L' for Laki-laki, 'P' for Perempuan
            $table->timestamps();

            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('siswas');
    }
}
