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
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id') // menambahkan kolom category_id di tabel products
                ->nullable() // membuat category_id boleh kosong agar data product lama tidak error
                ->after('user_id') // posisi kolom category_id diletakkan setelah user_id
                ->constrained('categories') // category_id terhubung ke id pada tabel categories
                ->cascadeOnDelete(); // jika category dihapus, product yang terkait ikut terhapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // menghapus relasi foreign key category_id
            $table->dropColumn('category_id'); // menghapus kolom category_id dari tabel products
        });
    }
};
