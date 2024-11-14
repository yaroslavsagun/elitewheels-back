<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brandIds = Brand::query()->pluck('id');
        $typeIds = Type::query()->pluck('id');
        $userIds = User::query()->pluck('id');
        $cars = [
            ['user_id' => fake()->randomElement($userIds), 'name' => 'Ferrari F8', 'brand_id' => fake()->randomElement($brandIds), 'type_id' => fake()->randomElement($typeIds), 'price' => 300000, 'color' => 'Red', 'description' => 'A luxury supercar', 'is_popular' => true],
            ['user_id' => fake()->randomElement($userIds), 'name' => 'Lamborghini Aventador', 'brand_id' => fake()->randomElement($brandIds), 'type_id' => fake()->randomElement($typeIds), 'price' => 400000, 'color' => 'Yellow', 'description' => 'A luxury supercar', 'is_popular' => true],
            ['user_id' => fake()->randomElement($userIds), 'name' => 'Porsche 911', 'brand_id' => fake()->randomElement($brandIds), 'type_id' => fake()->randomElement($typeIds), 'price' => 150000, 'color' => 'Black', 'description' => 'A luxury supercar', 'is_popular' => true],
            ['user_id' => fake()->randomElement($userIds), 'name' => 'Bentley Continental', 'brand_id' => fake()->randomElement($brandIds), 'type_id' => fake()->randomElement($typeIds), 'price' => 200000, 'color' => 'Blue', 'description' => 'A luxury sedan', 'is_popular' => false],
            ['user_id' => fake()->randomElement($userIds), 'name' => 'Rolls-Royce Phantom', 'brand_id' => fake()->randomElement($brandIds), 'type_id' => fake()->randomElement($typeIds), 'price' => 450000, 'color' => 'White', 'description' => 'A luxury sedan', 'is_popular' => false],
        ];

        foreach ($cars as $car) {
            Car::query()->create($car);
        }
    }
}
