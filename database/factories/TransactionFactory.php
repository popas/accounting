<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount'     => $this->faker->numberBetween(1, 1000),
            'type'       => $this->faker->randomElement(['income', 'expense']),
            'title'      => $this->faker->word,
            'author_id'  => 1,
            'created_at' => $this->faker->dateTimeBetween('-3 years', 'now')
        ];
    }
}
