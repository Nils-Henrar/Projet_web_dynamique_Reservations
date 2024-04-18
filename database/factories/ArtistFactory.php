<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Artist::class;

    public function definition(): array
    {
        return [

            'firstname' => $this->faker->firstname(),
            'lastname' => $this->faker->lastname(),
        ];
    }
}
