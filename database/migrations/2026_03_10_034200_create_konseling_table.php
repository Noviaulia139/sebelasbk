<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('konseling', function (Blueprint $table) {

            $table->integer('id_konseling')->autoIncrement();

            $table->integer('id_siswa');
            $table->integer('id_guru')->nullable();

            $table->text('masalah');
            $table->text('solusi')->nullable();

            $table->date('tanggal');

            $table->enum('status', ['terjadwal','selesai','batal'])
                  ->default('terjadwal');

            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('id_siswa')
                  ->references('id_siswa')
                  ->on('siswa')
                  ->onDelete('cascade');

            $table->foreign('id_guru')
                  ->references('id_guru')
                  ->on('guru_bk')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konseling');
    }
};