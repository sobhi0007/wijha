<?php

namespace Database\Seeders;

use App\Models\View;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViewSeeder extends Seeder
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
                'name_en' => 'pool view',
                'name_ar' => 'اطلالة المسبح',
            ],
            [
                'name_en' => 'sea view',
                'name_ar' => 'اطلالة البحر',
            ],
            [
                'name_en' => 'garden view',
                'name_ar' => 'اطلالة الحديقة',
            ],
        ];
        foreach ($data as $type) {
            View::updateOrCreate(['name_en' => $type['name_en']], $type);
        }
    }
}
