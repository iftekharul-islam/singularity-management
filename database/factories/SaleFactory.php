<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'store' => $this->faker->name,
            'brand' => $this->faker->name,
            'product_category' => $this->faker->name,
            'product_name' => $this->faker->name,
            'price' => 500,
        ];
    }
}
