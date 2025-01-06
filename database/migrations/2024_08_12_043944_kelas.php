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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id(); // Membuat kolom id dengan tipe data integer auto-increment
            $table->string('name'); // Membuat kolom name dengan tipe data string
            $table->integer('jumlah'); // Membuat kolom jumlah dengan tipe data integer
            $table->timestamps(); // Membuat kolom created_at dan updated_at dengan tipe data timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas'); // Menghapus tabel kelas jika migrasi dibatalkan
    }
};
