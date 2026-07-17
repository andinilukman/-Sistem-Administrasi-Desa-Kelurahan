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
        Schema::create('aparat_desas', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 30)->unique();
            $table->string('nama_lengkap');
            $table->string('jabatan');
            $table->string('jenis_kelamin', 15);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nomor_telepon', 20)->nullable();
            $table->string('email')->nullable();
            $table->text('alamat');
            $table->string('foto')->nullable();
            $table->string('status_aktif', 20)->default('Aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aparat_desas');
    }
};
