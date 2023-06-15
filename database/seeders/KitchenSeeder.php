<?php

namespace Database\Seeders;

use App\Models\Kitchen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KitchenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name_en' => 'Freezer',
                'name_ar' => 'فريزر',
            ],
            [
                'name_en' => 'microwave',
                'name_ar' => 'ميكروويف',
            ],
            [
                'name_en' => 'boiler',
                'name_ar' => 'غلاية',
            ],
        ];
        foreach ($data as $type) {
            Kitchen::updateOrCreate(['name_en' => $type['name_en']], $type);
        }
    }
}
