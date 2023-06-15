<?php

namespace Database\Seeders;

use App\Models\PermissionGroup;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('permissionsArray') as $item) {
            $group = PermissionGroup::updateOrCreate(['value' => $item['group_value']], [
                'name' => $item['group_name'],
                'value' => $item['group_value'],
            ]);

            foreach ($item['permissions'] as $permission) {
                Permission::updateOrCreate(['name' => $permission], [
                    'name' => $permission,
                    'guard_name' => 'admin',
                    'group_id' => $group->id,
                ]);
            }
        }
    }
}
