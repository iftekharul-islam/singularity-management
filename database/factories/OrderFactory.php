<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->name,
            'order_no' => rand(0, 99999),
            'amount' => 200,
            'status' => 'Processing',
            'paid_by' => 'Cash On Delivery',
        ];
    }
}
