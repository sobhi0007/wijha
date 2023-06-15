<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
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
                'name_en' => 'singles',
                'name_ar' => 'عذاب',
            ],
            [
                'name_en' => 'couples',
                'name_ar' => 'عوائل فقط',
            ],
            [
                'name_en' => 'families',
                'name_ar' => 'عائلات',
            ],
        ];
        foreach ($data as $type) {
            Person::updateOrCreate(['name_en' => $type['name_en']], $type);
        }
    }
}
