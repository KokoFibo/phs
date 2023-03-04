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
        Schema::create('pesertakelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('datapelita_id');
            $table->foreignId('daftarkelas_id');
            $table->unique(['datapelita_id', 'daftarkelas_id']);
            $table->boolean('pesertakelas_is_used')->default(false);

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
        Schema::dropIfExists('pesertakelas');
    }
};
