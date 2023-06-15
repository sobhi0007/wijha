<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
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
                'name_en' => 'Special Offer',
                'name_ar' => 'عرض خاص',
            ],
            [
                'name_en' => 'Gold Offer',
                'name_ar' => 'عرض ذهبى',
            ],
        ];
        foreach ($data as $type) {
            Badge::updateOrCreate(['name_en' => $type['name_en']], $type);
        }
    }
}
