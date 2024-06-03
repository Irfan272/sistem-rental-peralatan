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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('rental_id');
            $table->foreign('rental_id')->references('id')->on('rentals')->onDelete('cascade');

            $table->date('tanggal_pengembalian');
            $table->string('kondisi_alat');
      
            $table->decimal('denda_perhari', 10,2)->default(0);
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
        Schema::dropIfExists('pengembalians');
    }
};
