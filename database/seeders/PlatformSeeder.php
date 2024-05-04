<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_platform = [
            'shopee',
            'tokopedia',
            'lazada',
            'offline',
        ];

        foreach ($data_platform as $item) {
            $data = new Platform();
            $data->name = $item;
            $data->save();
        }
    }
}
