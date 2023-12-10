<?php

namespace Modules\Products\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Products\app\Models\Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => implode(" ", $this->faker->words),
            'quantity' => $this->faker->randomNumber(2),
            'image' => $this->getImage()
        ];
    }


    private function getImage(): string
    {
        return "uploads/images/products/{$this->faker->image(public_path("uploads/images/products") , fullPath: false)}";
    }
}

