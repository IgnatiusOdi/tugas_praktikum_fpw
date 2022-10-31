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
        Schema::create('matakuliah', function (Blueprint $table) {
            $table->id();
            $table->string('matakuliah_kode');
            $table->string('matakuliah_nama');
            $table->foreignId('jurusan_id')->constrained('jurusan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('matakuliah_semester');
            $table->integer('matakuliah_sks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matakuliah');
    }
};
