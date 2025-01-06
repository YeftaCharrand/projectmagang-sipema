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
        Schema::create('kaprodi', function (Blueprint $table) {
            $table->id(); // Kolom id sebagai primary key
            $table->unsignedBigInteger('user_id')->unique(); // Kolom user_id dengan unique constraint
            $table->integer('kode_dosen')->unique(); // Kolom kode_dosen dengan unique constraint
            $table->integer('nip')->unique(); // Kolom nip dengan unique constraint
            $table->string('name'); // Kolom name
            $table->timestamps(); // Kolom created_at dan updated_at

            // Menambahkan foreign key constraint jika diperlukan
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kaprodi');
    }
};
