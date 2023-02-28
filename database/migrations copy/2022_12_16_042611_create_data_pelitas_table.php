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

            $table->string('nama_umat');
            $table->string('nama_alias')->nullable();
            $table->string('mandarin')->nullable();
            $table->string('gender');
            $table->date('tgl_lahir');
            $table->integer('umur_sekarang')->nullable();
            $table->string('alamat');
            // $table->string('kota');
            $table->foreignId('kota_id');


            $table->string('telp')->nullable();
            $table->string('hp')->nullable();
            $table->string('email')->nullable();
            $table->string('pengajak');
            $table->string('penjamin');
            $table->foreignId('pandita_id');
            $table->date('tgl_mohonTao')->nullable();
            $table->date('tgl_sd3h')->nullable();
            $table->date('tgl_vtotal')->nullable();
            $table->string('status');
            $table->string('keterangan')->nullable();

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
