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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('mahasiswa_nrp')->unique();
            $table->string('mahasiswa_nama');
            $table->string('mahasiswa_email')->unique();
            $table->string('mahasiswa_telepon')->unique();
            $table->date('mahasiswa_tanggal_lahir');
            $table->foreignId('jurusan_id')->constrained('jurusan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('mahasiswa_angkatan');
            $table->string('mahasiswa_password');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
};
