<?php

namespace Database\Factories;

use App\Models\Expenditure;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenditureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expenditure::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = ['online', "offline"];
        return [
            "name_product" => $this->faker->word(5),
            "name_suplier" => $this->faker->company(),
            "balance" => $this->faker->numberBetween(1000000, 5000000),
            "price" => $this->faker->numberBetween(50000, 100000),
            "stock" => rand(10, 50),
            "type" => $type[rand(0, 1)],
            "status" => "pending",
            "notes" => $this->faker->paragraph(1)
        ];
    }
}
