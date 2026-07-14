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
        Schema::create('tagihans', function (Blueprint $table) {
            // Primary key for the billing record.
            $table->id();

            // Foreign key to the pelanggan table.
            // The default database behavior keeps the relationship protected to preserve data integrity.
            $table->foreignId('pelanggan_id')->constrained()->restrictOnDelete();

            // Billing period and accounting fields.
            $table->string('periode', 20);
            $table->decimal('nominal', 15, 2);
            $table->date('jatuh_tempo');
            $table->enum('status_pembayaran', ['Belum Bayar', 'Lunas'])->default('Belum Bayar');
            $table->date('tanggal_bayar')->nullable();
            $table->dateTime('tanggal_import')->nullable();
            $table->text('keterangan')->nullable();

            // Standard Laravel audit columns.
            $table->timestamps();

            // Unique budget identity for the same customer within the same billing period.
            $table->unique(['pelanggan_id', 'periode']);

            // Additional indexes for dashboard and reminder queries.
            $table->index('periode');
            $table->index('jatuh_tempo');
            $table->index('status_pembayaran');
            $table->index('tanggal_import');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
