<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'title' => 'Dishes',
        ]);

        Category::create([
            'title' => 'Recreational',
        ]);
        Category::create([
            'title' => 'Events',
        ]);
        Category::create([
            'title' => 'Dining',
        ]);
    }
}
