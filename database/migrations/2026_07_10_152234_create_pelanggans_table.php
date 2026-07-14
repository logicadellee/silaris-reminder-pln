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
        Schema::create('pelanggans', function (Blueprint $table) {
            // Primary key for the master customer table.
            $table->id();

            // Unique business identifier for the customer.
            $table->string('id_pelanggan')->unique();

            // Core identity and contact fields.
            $table->string('nama_pelanggan');
            $table->string('nomor_whatsapp', 30)->nullable();
            $table->string('tarif', 100)->nullable();
            $table->string('daya', 50)->nullable();
            $table->text('alamat')->nullable();
            $table->string('peruntukan_listrik', 100)->nullable();
            $table->string('status_pelanggan', 50)->default('Aktif');

            // Standard Laravel audit columns.
            $table->timestamps();

            // Indexes to support search and dashboard filtering.
            $table->index('nama_pelanggan');
            $table->index('nomor_whatsapp');
            $table->index('status_pelanggan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};
