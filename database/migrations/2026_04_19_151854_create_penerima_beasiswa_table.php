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
        Schema::create('penerima_beasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('beasiswa_id')->constrained('beasiswa')->cascadeOnDelete();
            $table->string('nomor_sk')->nullable();
            $table->string('file_sk')->nullable();
            $table->enum('status_penerima', [
                'pending', 'aktif', 'berhenti', 'selesai', 'ditolak'
            ])->default('pending');
            $table->text('alasan_perubahan_status')->nullable();
            $table->foreignId('validated_by_admin')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima_beasiswa');
    }
};
