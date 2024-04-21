<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book_Cate;

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
            "Mystery",
            "Horror",
            "Fantasy",
            "Thriller",
            "Cookbook"
        ];

        foreach ($categories as $category) {

            $availability = Book_Cate::where('name', $category)->first();

            if (!$availability) {
                Book_Cate::insert(['name' => $category]);
            }
        }
    }
}
