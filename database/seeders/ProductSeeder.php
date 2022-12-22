<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create(
            [
                'name' => 'Milkuat',
                'price' => 5000
            ]
        );

        Product::create(
            [
                'name' => 'Indomilk Coklat',
                'price' => 6000
            ]
        );
    }
}
