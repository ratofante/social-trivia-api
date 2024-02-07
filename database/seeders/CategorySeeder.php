<?php

namespace Database\Seeders;

use App\Models\Category;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        $this->truncate('categories');

        $categories = include(database_path('data/initial_categories.php'));

        foreach ($categories as $category) {
            Category::create([
                "name" => $category
            ]);
        }

        $this->enableForeignKeys();
    }
}
