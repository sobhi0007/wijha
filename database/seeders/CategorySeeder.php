<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name_en' => 'chalets',
                'name_ar' => 'شاليهات',
                'slug' => 'chalets',
            ],
            [
                'name_en' => 'resorts',
                'name_ar' => 'منتجعات',
                'slug' => 'resorts',
            ],
            [
                'name_en' => 'villas',
                'name_ar' => 'فيلات',
                'slug' => 'villas',
            ],
            [
                'name_en' => 'apartments',
                'name_ar' => 'شقق',
                'slug' => 'apartments',
            ],
        ];
        foreach ($categories as $category) {
            Category::updateOrCreate(['name_en' => $category['name_en']], $category);
        }
    }
}
