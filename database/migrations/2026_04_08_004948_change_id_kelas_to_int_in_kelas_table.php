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
    Schema::table('kelas', function (Blueprint $table) {
        $table->dropColumn('id_kelas');
    });

    Schema::table('kelas', function (Blueprint $table) {
        $table->id('id_kelas')->first();
    });
}

public function down()
{
    Schema::table('kelas', function (Blueprint $table) {
        $table->dropColumn('id_kelas');
    });

    Schema::table('kelas', function (Blueprint $table) {
        $table->string('id_kelas')->first();
    });
}

};
