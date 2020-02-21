<?php

use Illuminate\Database\Seeder;

class RouteGalleryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Model\Route\RouteGalleryCategory::create(["route_id" => 1, "name" => "Version 1"]);
        \App\Model\Route\RouteGalleryCategory::create(["route_id" => 1, "name" => "Version 2"]);
        \App\Model\Route\RouteGalleryCategory::create(["route_id" => 1, "name" => "Version 3"]);
        \App\Model\Route\RouteGalleryCategory::create(["route_id" => 1, "name" => "Version 4"]);
        \App\Model\Route\RouteGalleryCategory::create(["route_id" => 1, "name" => "Version 5"]);
        \App\Model\Route\RouteGalleryCategory::create(["route_id" => 1, "name" => "Version 6"]);
        \App\Model\Route\RouteGalleryCategory::create(["route_id" => 1, "name" => "Version 7"]);
        \App\Model\Route\RouteGalleryCategory::create(["route_id" => 1, "name" => "Version 8"]);
    }
}
