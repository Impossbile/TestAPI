<?php

namespace Database\Factories;
use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        Card::factory()
            ->count(50)
            ->create();

    }
}
