<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product' => $this->faker->word(),
            'category' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(1, 200),
            'price' => $this->faker->numberBetween(10,50),
            'expiry' => $this->faker->date(),
            'sizes' => 's, m, l',
            'description' => $this->faker->paragraph(5),
        ];
    }
}
