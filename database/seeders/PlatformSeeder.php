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
            if ($item == 'shopee') {
                $data->admin_cost = 0.93;
            }
            if ($item == 'tokopedia') {
                $data->admin_cost = 0.955;
            }
            if ($item == 'lazada') {
                $data->admin_cost = 0.98;
            }
            $data->save();
        }
    }
}
