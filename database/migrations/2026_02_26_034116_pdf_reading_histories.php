<?php
// database/migrations/2024_01_01_000004_create_reading_histories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pdf_reading_histories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('pdf_book_id')
                  ->constrained('pdf_books')
                  ->cascadeOnDelete();

            $table->timestamp('last_read_at')->useCurrent();
            $table->integer('read_count')->default(1);
            $table->integer('last_page')->nullable();
            $table->integer('reading_progress')->default(0)->comment('Percentage complete 0-100');

            $table->timestamps();

            // Track unique reading sessions per user per book
            $table->unique(['user_id', 'pdf_book_id'], 'pdf_reading_histories_user_book_unique');

            // Indexes for analytics
            $table->index('last_read_at');
            $table->index('read_count');
            $table->index(['user_id', 'last_read_at']);
            $table->index(['pdf_book_id', 'read_count']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pdf_reading_histories');
    }
};
