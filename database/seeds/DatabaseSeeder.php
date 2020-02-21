<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Utilisateurs

        $this->call(UserSeeder::class);
        $this->call(UserAccountSeeder::class);
        $this->call(UserSocialSeeder::class);
        $this->call(UserpremiaSeeder::class);
        $this->call(UserPaymentSeeder::class);

        // Core
        $this->call(TrainzBuildSeeder::class);
        $this->call(RouteTypeDownloadSeeder::class);
        $this->call(RouteTypeReleaseSeeder::class);

        // Blog
        $this->call(BlogCategorySeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(BlogTagSeeder::class);
        $this->call(BlogCommentSeeder::class);
        $this->call(SlideshowSeeder::class);

        // Route

        $this->call(RouteSeeder::class);
        $this->call(RouteAnomalieSeeder::class);
        $this->call(RouteBuildSeeder::class);
        $this->call(RouteCompatibilitiesSeeder::class);
        $this->call(RouteTimelineSeeder::class);
        $this->call(RouteGalleryCategorySeeder::class);
        $this->call(RouteGallerySeeder::class);

        // Asset
        $this->call(AssetCategoriesSeeder::class);
        $this->call(AssetSubCategoriesSeeder::class);
        $this->call(AssetSeeder::class);
        $this->call(AssetTagSeeder::class);
        $this->call(AssetCompatibilitiesSeeder::class);

        // Tutoriel

        $this->call(TutorielCategorySeeder::class);
        $this->call(TutorielSubCategorySeeder::class);
        $this->call(TutorielSeeder::class);
        $this->call(TutorielTagSeeder::class);
        $this->call(TutorielCommentSeeder::class);
        $this->call(TutorielSourceSeeder::class);
    }
}
