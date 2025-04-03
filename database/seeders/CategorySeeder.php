<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Romans',
            'Science-Fiction',
            'Histoire',
            'Éducation',
            'Biographies',
            'Jeunesse',
            'Poésie',
            'Art et Culture'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}