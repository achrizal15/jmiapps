<?php

namespace Database\Factories;

use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Package::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $features = ['Kecepatan', "Customer Login", "Keranjang Belanja", "Wishlist", "Payment Gateway"];
        return [
            "name" => $this->faker->unique()->word(),
            "feature" => $features[rand(0, 4)] . "," . $this->faker->text(10),
            "price" => $this->faker->numberBetween(100000, 1000000),
            "note" => $this->faker->text(50),
        ];
    }
}
