<?php
// database/migrations/xxxx_create_products_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // RELASI KE CATEGORIES
            $table->foreignId('category_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // INFORMASI DASAR
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // HARGA
            $table->decimal('price', 18, 2);
            $table->decimal('discount_price', 18, 2)->nullable();

            // STOK & BERAT
            $table->integer('stock')->default(0);
            $table->integer('weight')->default(0)->comment('dalam gram');

            // STATUS VISIBILITAS
            $table->boolean('is_active')->default(true);
            $table->boolean('is_featured')->default(false);

            // --- TAMBAHKAN INI UNTUK SOLUSI ERROR ANDA ---
            $table->softDeletes(); // Menambahkan kolom 'deleted_at'
            // ---------------------------------------------

            $table->timestamps();

            // INDEXING
            $table->index(['category_id', 'is_active']);
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};