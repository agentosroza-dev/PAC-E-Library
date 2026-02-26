<?php
// database/migrations/2024_01_01_000001_create_categories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pdf_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title', 1024);
            $table->text('description')->nullable();
            $table->timestamps();

            // Add indexes for better performance
            $table->index('title');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pdf_categories'); // FIXED: Changed from 'categories' to 'pdf_categories'
    }
};
