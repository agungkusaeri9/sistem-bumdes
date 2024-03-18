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
        Schema::table('transaksi', function (Blueprint $table) {
            $table->string('kode')->nullable()->unique();
            $table->enum('jenis_pembayaran', ['manual', 'otomatis'])->default('manual');
            $table->string('snap_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            $table->dropColumn('kode');
            $table->dropColumn('jenis_pembayaran');
            $table->dropColumn('snap_token');
        });
    }
};
