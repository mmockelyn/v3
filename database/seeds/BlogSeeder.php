<?php

use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(env('APP_ENV') == 'local')
        {
            $categories = \App\Model\Blog\BlogCategory::get();
            foreach ($categories as $category)
            {
                for($i=0; $i < 10; $i++) {
                    factory(\App\Model\Blog\Blog::class)->create();
                }
            }
        }
    }
}
