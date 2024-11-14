<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Ferrari', 'logo' => 'logos/ferrari.png'],
            ['name' => 'Lamborghini', 'logo' => 'logos/lamborghini.png'],
            ['name' => 'Porsche', 'logo' => 'logos/porsche.png'],
            ['name' => 'Bentley', 'logo' => 'logos/bentley.png'],
            ['name' => 'Rolls-Royce', 'logo' => 'logos/rolls-royce.png'],
            ['name' => 'Aston Martin', 'logo' => 'logos/aston-martin.png'],
            ['name' => 'Maserati', 'logo' => 'logos/maserati.png'],
        ];

        foreach ($brands as $brand) {
            Brand::query()->create($brand);
        }
    }
}
