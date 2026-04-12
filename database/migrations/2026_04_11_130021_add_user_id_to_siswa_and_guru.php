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
    Schema::table('siswa', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable()->after('id_siswa');
    });

    Schema::table('guru_bk', function (Blueprint $table) {
        $table->unsignedBigInteger('user_id')->nullable()->after('id_guru');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswa_and_guru', function (Blueprint $table) {
            //
        });
    }
};
