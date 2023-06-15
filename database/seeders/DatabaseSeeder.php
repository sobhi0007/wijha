<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            PermissionSeeder::class,
            SettingSeeder::class,
            CategorySeeder::class,
            TypeSeeder::class,
            CapacitySeeder::class,
            PersonSeeder::class,
            ViewSeeder::class,
            BadgeSeeder::class,
            KitchenSeeder::class,
            ToiletSeeder::class,

        ]);
    }
}
