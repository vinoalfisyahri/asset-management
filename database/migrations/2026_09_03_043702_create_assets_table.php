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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->string('kode_asset')->unique();
            $table->string('nama_asset');
            $table->string('foto')->nullable();
            $table->integer('masa_manfaat'); // dalam satuan tahun
            $table->decimal('harga_perolehan', 15, 2);
            $table->decimal('nilai_penyusutan_terakhir', 15, 2);
            $table->enum('status', ['Tersedia', 'Dipinjam', 'Maintenance', 'Rusak'])->default('Tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
