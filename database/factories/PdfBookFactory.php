<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\PdfBook;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PdfBook>
 */
class PdfBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4), // More realistic book title
            'description' => $this->faker->paragraphs(3, true), // Fixed typo and method name
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'status' => $this->faker->boolean,
            'version' => $this->faker->randomElement(['1.0', '1.1', '2.0', '2.5']), // Random version
            'image' => 'default.png',
            'file' => 'sample.pdf', // Placeholder for file
        ];
    }
}
