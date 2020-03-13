<?php

namespace Tests\Feature\Front\Blog;

use App\Model\Blog\Blog;
use App\Model\Blog\BlogComment;
use App\Repository\Blog\BlogRepository;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_shown_index_page()
    {
        $this->withoutExceptionHandling();

        $this->get('/blog')
            ->assertSuccessful()
            ->assertViewIs('front.blog.index');

        // Appel Ajax In Pages
        $this->getJson('/blog/api/loadCarousel')
            ->assertSuccessful();

        $this->getJson('/blog/api/loadNews')
            ->assertSuccessful();
    }

    /** @test */
    function it_shown_show_page()
    {
        $this->withoutExceptionHandling();

        $blog = factory(Blog::class)->create([
            "published" => 1,
            "published_at" => now()
        ]);

        $this->get('/blog/' . $blog->slug)
            ->assertSuccessful()
            ->assertViewIs('front.blog.show')
            ->assertSee($blog->title);
    }

    /** @test */

    function post_comment_to_blog_show()
    {
        $user = factory(User::class)->create();
        $blog = factory(Blog::class)->create([
            "published" => 1,
            "published_at" => now()
        ]);

        $this->actingAs($user)->post("/blog/api/{$blog->id}/comments", ["comment" => "fjkdksjfklsdjfkldsjfkldsjflksdjfsdklfjsldf"])
            ->assertSuccessful();
    }

    function test_post_comment_error_validation()
    {
        $user = factory(User::class)->create();
        $blog = factory(Blog::class)->create([
            "published" => 1,
            "published_at" => now()
        ]);

        $this->actingAs($user)->post("/blog/api/{$blog->id}/comments", ["comment" => null])
            ->assertStatus(203);
    }

    function test_delete_comment_to_blog_show()
    {
        $user = factory(User::class)->create();
        $blog = factory(Blog::class)->create([
            "published" => 1,
            "published_at" => now()
        ]);
        $comment = factory(BlogComment::class)->create();

        $this->actingAs($user)->getJson("/blog/api/{$blog->id}/comment/{$comment->id}")
            ->assertStatus(200)
            ->assertJson([
                "data" => "Done"
            ]);

    }


}
