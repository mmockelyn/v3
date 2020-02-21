<?php

use Faker\Generator;
use Illuminate\Database\Seeder;

class BlogCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param Generator $faker
     * @return void
     */
    public function run(Generator $faker)
    {
        if (env("APP_ENV") == 'local') {
            $blogs = \App\Model\Blog\Blog::get();
            $count_user = \App\User::count();
            $countComment = rand(1, 7);

            foreach ($blogs as $blog) {
                for ($i = 0; $i < $countComment; $i++) {
                    $random_user = rand(1, $count_user);
                    $user = \App\User::find($random_user);

                    \App\Model\Blog\BlogComment::create([
                        "blog_id" => $blog->id,
                        "user_id" => $user->id,
                        "comment"   => $faker->text(rand(50, 350)),
                        "created_at" => now()->subDays(rand(0,100)),
                        "updated_at" => now()->subDays(rand(0,100))
                    ]);
                }
            }
        }
    }
}
