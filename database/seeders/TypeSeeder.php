<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeSeeder extends Seeder
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
                'name_en' => 'farm',
                'name_ar' => 'مزرعة',
            ],
            [
                'name_en' => 'room',
                'name_ar' => 'غرفة',
            ],
            [
                'name_en' => 'istraha',
                'name_ar' => 'استراحة',
            ],
            [
                'name_en' => 'chalet',
                'name_ar' => 'شالية',
            ],
        ];
        foreach ($data as $type) {
            Type::updateOrCreate(['name_en' => $type['name_en']], $type);
        }
    }
}
