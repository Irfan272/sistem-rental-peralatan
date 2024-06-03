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
        Schema::create('alats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_id');
            $table->foreign('jenis_id')->references('id')->on('jenis')->onDelete('cascade');
            
            $table->string('no_alat');
            $table->string('merk');
            $table->string('nama_alat');
            $table->decimal('harga_perhari', 10,2)->default(0);
            $table->decimal('denda_perhari', 10,2)->default(0);
            $table->string('status');
            $table->string('gambar_alat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alats');
    }
};
