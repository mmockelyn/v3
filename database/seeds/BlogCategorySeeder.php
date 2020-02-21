<?php

use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Blog\BlogCategory::create(["name" => "Trainz en général"]);
        \App\Model\Blog\BlogCategory::create(["name" => "Release"]);
        \App\Model\Blog\BlogCategory::create(["name" => "Création"]);
        \App\Model\Blog\BlogCategory::create(["name" => "Site Web"]);
    }
}
