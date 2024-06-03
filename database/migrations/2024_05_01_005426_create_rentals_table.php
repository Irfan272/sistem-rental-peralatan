<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->string('no_invoice')->unique();

            $table->unsignedBigInteger('pelanggan_id');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggans')->onDelete('cascade');

            $table->unsignedBigInteger('alat_id');
            $table->foreign('alat_id')->references('id')->on('alats')->onDelete('cascade');

            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->date('tanggal_pengembalian')->nullable();
            $table->string('lama_sewa');
            $table->decimal('biaya_sewa', 10,2)->default(0);
            $table->decimal('denda_perhari', 10,2)->default(0);
            $table->string('status_pembayaran');
            $table->string('status_rental');
            $table->string('status_pengembalian');
            $table->decimal('total_pembayaran', 10,2)->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
