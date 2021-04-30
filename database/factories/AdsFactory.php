<?php

namespace Database\Factories;

use App\Models\Ads;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ads::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(25),
            'description' => $this->faker->realText(200),
            'price' => $this->faker->numberBetween(10, 10000),
            'created_at' => $this->faker->dateTimeThisMonth('now'),
            'category_id' => $this->faker->numberBetween(1, 5)
        ];
    }
}
