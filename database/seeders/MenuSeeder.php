<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tambahkan data menu ke dalam tabel
        Menu::create([
            'label' => 'Home',
            'url' => '/home',
        ]);

        Menu::create([
            'label' => 'About',
            'url' => '/about',
        ]);
    }
}
