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
        Schema::create('usersettings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->integer('rows')->default(10);
            $table->integer('kota_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->integer('groupvihara_id')->nullable();
            $table->integer('pandita_id')->nullable();

            $table->boolean('id_umat')->default(false);
            $table->boolean('branch')->default(false);
            $table->boolean('nama_umat')->default(true);
            $table->boolean('nama_alias')->default(true);
            $table->boolean('mandarin')->default(true);
            $table->boolean('gender')->default(true);
            $table->boolean('group')->default(true);
            $table->boolean('tgl_lahir')->default(false);
            $table->boolean('umur_sekarang')->default(true);
            $table->boolean('alamat')->default(false);
            $table->boolean('kota')->default(true);
            $table->boolean('telp')->default(false);
            $table->boolean('hp')->default(false);
            $table->boolean('email')->default(false);
            $table->boolean('pengajak')->default(true);
            $table->boolean('penjamin')->default(true);
            $table->boolean('pandita')->default(true);
            $table->boolean('tgl_mohonTao')->default(false);
            $table->boolean('tgl_sd3h')->default(false);
            $table->boolean('tgl_vtotal')->default(false);
            $table->boolean('status')->default(false);
            $table->boolean('tgl_keterangan')->default(false);
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
        Schema::dropIfExists('usersettings');
    }
};
