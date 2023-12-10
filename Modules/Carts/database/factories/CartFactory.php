<?php

namespace Modules\Carts\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Carts\app\Models\Cart::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

