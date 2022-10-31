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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matakuliah_id')->constrained('matakuliah')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('hari_id')->constrained('hari')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('jam_id')->constrained('jam')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('periode_id')->constrained('periode')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('dosen_id')->constrained('dosen')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelas');
    }
};
