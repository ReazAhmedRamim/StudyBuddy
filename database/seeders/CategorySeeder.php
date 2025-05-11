<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Programming', 'slug' => 'programming', 'image' => 'uploads/category/programming.png'],
            ['name' => 'Design', 'slug' => 'design', 'image' => 'uploads/category/design.png'],
            ['name' => 'Marketing', 'slug' => 'marketing', 'image' => 'uploads/category/marketing.png'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => $category['slug']], $category);
        }
    }
}

