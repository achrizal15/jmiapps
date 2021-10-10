<?php

namespace Database\Factories;

use App\Models\Salary;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Salary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => rand(1, 50),
            "balance" => $this->faker->numberBetween(2000000, 2500000),
            "pay_cut" => $this->faker->numberBetween(0, 500000),
            "bonus" => $this->faker->numberBetween(0, 1000000),
            "note" => $this->faker->paragraph(1),
        ];
    }
}
