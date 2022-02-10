<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['banks-create','banks-edit','banks-read','banks-delete'] as $name){
            Permission::create([
                    'name' => $name
            ]);
        }
    }
}
