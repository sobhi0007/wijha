<?php

namespace Database\Seeders;

use App\Models\Toilet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToiletSeeder extends Seeder
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
                'name_en' => 'Shampoo',
                'name_ar' => 'شاميو',
            ],
            [
                'name_en' => 'Jacouzi',
                'name_ar' => 'جاكوزى',
            ],
            [
                'name_en' => 'swna',
                'name_ar' => 'ساونا',
            ],
        ];
        foreach ($data as $type) {
            Toilet::updateOrCreate(['name_en' => $type['name_en']], $type);
        }
    }
}
