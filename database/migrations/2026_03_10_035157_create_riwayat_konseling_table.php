<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_konseling', function (Blueprint $table) {

            $table->integer('id_riwayat')->autoIncrement();

            $table->integer('id_konseling');
            $table->integer('id_guru');

            $table->date('tanggal');

            $table->text('catatan');

            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('id_konseling')
                  ->references('id_konseling')
                  ->on('konseling')
                  ->onDelete('cascade');

            $table->foreign('id_guru')
                  ->references('id_guru')
                  ->on('guru_bk')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_konseling');
    }
};