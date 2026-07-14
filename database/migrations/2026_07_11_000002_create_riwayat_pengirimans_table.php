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
        Schema::create('riwayat_pengirimans', function (Blueprint $table) {
            // Primary key for the delivery history log.
            $table->id();

            // Customer reference for audit purposes.
            $table->foreignId('pelanggan_id')->constrained()->restrictOnDelete();

            // Billing context if the reminder is tied to a specific bill.
            $table->foreignId('tagihan_id')->nullable()->constrained()->nullOnDelete();

            // Admin/operator who performed the action.
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Reminder message metadata.
            $table->string('template_nama', 100);
            $table->text('isi_pesan');
            $table->enum('status_pengiriman', ['Pending', 'Berhasil', 'Gagal']);
            $table->dateTime('waktu_kirim')->nullable();
            $table->string('response_code', 50)->nullable();
            $table->text('response_message')->nullable();
            $table->text('keterangan')->nullable();

            // Standard Laravel audit columns.
            $table->timestamps();

            // Query indexes to support audit review and dashboard monitoring.
            $table->index('template_nama');
            $table->index('status_pengiriman');
            $table->index('waktu_kirim');
            $table->index(['pelanggan_id', 'waktu_kirim']);
            $table->index(['tagihan_id', 'status_pengiriman']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pengirimans');
    }
};
