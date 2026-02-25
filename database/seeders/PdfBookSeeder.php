<?php

namespace Database\Seeders;

use App\Models\PdfBook;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PdfBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PdfBook::factory()->count(count: 25)->create();
    }
}
