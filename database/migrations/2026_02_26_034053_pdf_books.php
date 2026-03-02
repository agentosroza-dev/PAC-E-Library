<?php
// database/migrations/2024_01_01_000002_create_pdf_books_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pdf_books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 1024);
            $table->text('description')->nullable();
            $table->boolean('status')->default(false);
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->integer('downloads')->default(0);
            $table->integer('userview')->default(0);
            $table->string('version')->default('1.0.0');

            // Foreign keys
            $table->foreignId('category_id')
                  ->constrained('pdf_categories')
                  ->cascadeOnDelete();

            $table->foreignId('uploaded_by')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->timestamps();

            // Indexes for better query performance
            $table->index('title');
            $table->index('status');
            $table->index('category_id');
            $table->index('uploaded_by');
            $table->index('created_at');
            $table->index('downloads');
            $table->index('userview');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pdf_books');
    }
};
