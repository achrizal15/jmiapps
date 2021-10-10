<?php

namespace Database\Factories;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Inventory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = ["ready", "broken"];
        return [
            "name" => $this->faker->word(),
            "status" => $status[rand(0, 1)],
            "stock" => $this->faker->numberBetween(1, 100),
            "price" => $this->faker->numberBetween(10000, 500000)
        ];
    }
}
