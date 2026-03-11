<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guru_bk', function (Blueprint $table) {

            $table->integer('id_guru')->autoIncrement()->primary();
            $table->string('nip')->unique();
            $table->string('nama');
            $table->string('password');
            $table->string('foto')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guru_bk');
    }
};