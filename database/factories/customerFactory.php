<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\customer>
 */
class customerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $address = ['yangon','mandalay','kume','pyay'];
        return [
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->text(200),
            'price' => rand(2000,50000),
            'address' => $address[array_rand($address)],
            'range' =>rand(0,10)
        ];
    }
}
