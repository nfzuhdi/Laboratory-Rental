<?php

use App\Models\kategori;
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
        Schema::create('alatlabs', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(Kategori::class)->nullable();
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
            $table->string('nama_alat')->nullable();
            $table->string('merek')->nullable();
            $table->string('kode')->unique();
            $table->string('jumlah')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alatlabs');
    }
};
