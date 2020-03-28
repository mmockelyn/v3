<?php

namespace Tests\Feature\Front\Download;

use App\Model\Asset\Asset;
use App\Model\Asset\AssetCategory;
use App\Model\Asset\AssetSubCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DownloadTest extends TestCase
{
    use RefreshDatabase;

    function test_index_show()
    {
        $this->withoutExceptionHandling();
        factory(AssetCategory::class)->create();

        $this->get('/download')
            ->assertSuccessful()
            ->assertViewIs('front.download.index');
    }

    function test_category_show()
    {
        $category = factory(AssetCategory::class)->create();

        $this->get('/download/'.$category->id)
            ->assertSuccessful()
            ->assertViewIs('front.download.category');
    }

    function test_list_show()
    {
        $category = factory(AssetCategory::class)->create();
        $sub = factory(AssetSubCategory::class)->create();

        $this->get('/download/'.$category->id.'/'.$sub->id)
            ->assertSuccessful()
            ->assertViewIs('front.download.list');
    }

    function test_show()
    {
        $category = factory(AssetCategory::class)->create();
        $sub = factory(AssetSubCategory::class)->create();
        $asset = factory(Asset::class)->create([
            "published" => 1,
            "published_at" => now()
        ]);

        $this->get('/download/'.$category->id.'/'.$sub->id.'/'.$asset->id)
            ->assertSuccessful()
            ->assertViewIs('front.download.show');
    }

    function test_mesh_show()
    {
        $category = factory(AssetCategory::class)->create();
        $sub = factory(AssetSubCategory::class)->create();
        $asset = factory(Asset::class)->create([
            "mesh" => 1,
            "published" => 1,
            "published_at" => now()
        ]);

        $this->get('/download/'.$category->id.'/'.$sub->id.'/'.$asset->id.'/mesh')
            ->assertSuccessful()
            ->assertViewIs('front.download.mesh');
    }

    function test_config_show()
    {
        $this->withoutExceptionHandling();
        $category = factory(AssetCategory::class)->create();
        $sub = factory(AssetSubCategory::class)->create();
        $asset = factory(Asset::class)->create([
            "config" => 1,
            "published" => 1,
            "published_at" => now()
        ]);

        $this->get('/download/'.$category->id.'/'.$sub->id.'/'.$asset->id.'/config')
            ->assertSuccessful()
            ->assertViewIs('front.download.config');
    }

    function test_increment_download()
    {
        $category = factory(AssetCategory::class)->create();
        $sub = factory(AssetSubCategory::class)->create();
        $asset = factory(Asset::class)->create([
            "config" => 1,
            "published" => 1,
            "published_at" => now()
        ]);

        $this->get('/download/'.$category->id.'/'.$sub->id.'/'.$asset->id.'/download')
            ->assertStatus(302);
    }
}
