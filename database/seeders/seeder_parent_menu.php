<?php

namespace Database\Seeders;

use App\Models\ParentMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seeder_parent_menu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ParentMenu::create([
            'label' => 'Master',
        ]);
    }
}
