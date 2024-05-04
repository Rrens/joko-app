<?php

namespace Database\Seeders;

use App\Models\ProductCategories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */



    public function run(): void
    {
        $categories = [
            'General Chemical',
            'Water Treatment',
            'Resin and Art',
            'Food Chemical',
            'Bibit Parfum'
        ];

        foreach ($categories as $item) {
            $data = new ProductCategories();
            $data->name = $item;
            $data->save();
        }
    }
}
