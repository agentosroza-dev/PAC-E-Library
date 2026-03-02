<?php
// database/migrations/2024_01_01_000003_create_favorites_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pdf_favorites', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('pdf_book_id')
                  ->constrained('pdf_books')
                  ->cascadeOnDelete();

            $table->timestamps();

            // Prevent duplicate favorites
            $table->unique(['user_id', 'pdf_book_id'], 'pdf_favorites_user_book_unique');

            // Indexes
            $table->index('user_id');
            $table->index('pdf_book_id');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pdf_favorites');
    }
};
