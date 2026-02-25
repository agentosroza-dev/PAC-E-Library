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
        Schema::create('pdf_books', function (Blueprint $table) {
            $table->id();
            $table->string('title', 1024);
            $table->string('description', 10240); // Fixed typo
            $table->boolean('status')->default(false);
            $table->string('version', 10)->default('1.0'); // Added reasonable length
            $table->string('image');
            $table->string('file');
            $table->integer('downloads')->default(0);
            $table->integer('userview')->default(0);

            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete(); // Fixed table name
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdf_books');
    }
};
