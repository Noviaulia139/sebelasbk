<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kelas', function (Blueprint $table) {

            $table->string('id_kelas')->primary();
            $table->string('nama_kelas');
            $table->string('jurusan');

            $table->integer('id_guru'); // harus sama tipe dengan guru_bk.id_guru

            $table->timestamps();

            $table->foreign('id_guru')
                  ->references('id_guru')
                  ->on('guru_bk')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};