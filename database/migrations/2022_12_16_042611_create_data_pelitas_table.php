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
        Schema::create('data_pelitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id');

            $table->string('nama');
            $table->string('mandarin')->nullable();
            $table->string('jenis_kelamin');
            $table->integer('umur');
            $table->integer('umur_sekarang')->nullable();
            $table->string('alamat');
            $table->string('kota');
            $table->string('telp')->nullable();
            $table->string('hp')->nullable();
            $table->string('email')->nullable();
            $table->string('pengajak');
            $table->string('penjamin');
            $table->string('pandita');
            $table->date('tgl_mohonTao')->default(now());
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_pelitas');
    }
};
