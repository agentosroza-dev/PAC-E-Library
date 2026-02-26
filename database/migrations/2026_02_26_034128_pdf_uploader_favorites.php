<?php
// database/migrations/2024_01_01_000005_create_uploader_favorites_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pdf_uploader_favorites', function (Blueprint $table) {
            $table->id();

            $table->foreignId('uploader_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('pdf_book_id')
                  ->constrained('pdf_books')
                  ->cascadeOnDelete();

            $table->text('notes')->nullable();
            $table->integer('priority')->default(0);

            $table->timestamps();

            // Prevent duplicate uploader favorites
            $table->unique(['uploader_id', 'pdf_book_id'], 'pdf_uploader_favorites_unique'); // FIXED: unique name

            // Indexes
            $table->index('priority');
            $table->index('uploader_id');
            $table->index('pdf_book_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pdf_uploader_favorites');
    }
};
