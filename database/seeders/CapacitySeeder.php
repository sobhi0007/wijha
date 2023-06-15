<?php

namespace Database\Seeders;

use App\Models\Capacity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CapacitySeeder extends Seeder
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
                'name_en' => '5-10 persons',
                'name_ar' => '5-10 اشخاص',
            ],
            [
                'name_en' => '1 person',
                'name_ar' => 'شخص واحد',
            ],
            [
                'name_en' => '2 persons',
                'name_ar' => 'شخصين',
            ],
            [
                'name_en' => '3 persons',
                'name_ar' => 'ثلاثة اشخاص',
            ],
        ];
        foreach ($data as $type) {
            Capacity::updateOrCreate(['name_en' => $type['name_en']], $type);
        }
    }
}
