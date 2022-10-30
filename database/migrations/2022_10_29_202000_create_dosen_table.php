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
        Schema::create('dosen', function (Blueprint $table) {
            $table->id();
            $table->string('dosen_username')->unique();
            $table->string('dosen_nama');
            $table->string('dosen_email')->unique();
            $table->string('dosen_telepon')->unique();
            $table->date('dosen_tanggal_lahir');
            $table->foreignId('jurusan_id')->constrained('jurusan')->cascadeOnDelete();
            $table->date('dosen_kelulusan');
            $table->string('dosen_password');
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
        Schema::dropIfExists('dosen');
    }
};
