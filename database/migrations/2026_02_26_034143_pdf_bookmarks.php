<?php
// database/migrations/2024_01_01_000006_create_bookmarks_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pdf_bookmarks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('pdf_book_id')
                  ->constrained('pdf_books')
                  ->cascadeOnDelete();

            $table->integer('page_number');
            $table->string('note', 255)->nullable();

            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('pdf_book_id');
            $table->index('page_number');
            $table->index('created_at');

            // Composite index for finding user bookmarks by page
            $table->index(['user_id', 'pdf_book_id', 'page_number'], 'pdf_bookmarks_user_book_page_index');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pdf_bookmarks');
    }
};
