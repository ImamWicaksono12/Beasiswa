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
        Schema::create('monitoring_akademik', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penerima_id')
                ->constrained('penerima_beasiswa')
                ->cascadeOnDelete();
            $table->integer('semester_ke');
            $table->float('ipk')->nullable();
            $table->float('ips')->nullable();
            $table->string('file_khs')->nullable();
            $table->text('esai_kegiatan')->nullable();
            $table->string('foto_dokumentasi')->nullable();
            $table->enum('status_monitoring', [
                'pending_kaprodi',
                'pending_admin',
                'disetujui',
                'revisi'
            ])->default('pending_kaprodi');
            $table->foreignId('val_akademik_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('val_admin_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->text('komentar_validator')->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_akademik');
    }
};
