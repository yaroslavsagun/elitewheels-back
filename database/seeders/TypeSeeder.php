<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'SUV'],
            ['name' => 'Supercar'],
            ['name' => 'Sedan'],
            ['name' => 'Coupe'],
            ['name' => 'Convertible'],
            ['name' => 'Hatchback'],
            ['name' => 'Wagon'],
            ['name' => 'Pickup'],
            ['name' => 'Van'],
            ['name' => 'Crossover'],
        ];

        foreach ($types as $type) {
            Type::query()->create($type);
        }
    }
}
