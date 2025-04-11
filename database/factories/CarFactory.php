<?php

namespace Database\Factories;

use App\Models\CarType;
use App\Models\City;
use App\Models\FuelType;
use App\Models\Maker;
use App\Models\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'maker_id' => Model::inRandomOrder()->first()->maker_id,
            'model_id' => function ($attributes) {
                return Model::where('maker_id', $attributes['maker_id'])->inRandomOrder()->first()->id;
            },
            'year' => $this->faker->year(),
            'price' => ((int)$this->faker->randomFloat(2, 5, 100)) * 1000,
            'vin' => $this->faker->unique()->regexify('[A-Z0-9]{17}'),
            'mileage' => $this->faker->numberBetween(5, 500000),            
            'car_type_id' => CarType::inRandomOrder()->first()->id,
            'fuel_type_id' => FuelType::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'city_id' => City::inRandomOrder()->first()->id,
            'address' => $this->faker->address(),
            'phone' => function($attributes) {
                return User::find($attributes['user_id'])->phone;
            },
            'description' => $this->faker->text(1500),
            'published_at' => $this->faker->optional(0.9)->dateTimeBetween('-10 month', '-1 day')
        ];
    }
}
