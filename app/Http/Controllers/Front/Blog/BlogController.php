<?php

namespace App\Http\Controllers\Front\Blog;

use App\Http\Controllers\Controller;
use App\Repository\Blog\BlogCommentRepository;
use App\Repository\Blog\BlogRepository;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * @var BlogRepository
     */
    private $blogRepository;
    /**
     * @var BlogCommentRepository
     */
    private $blogCommentRepository;

    /**
     * BlogController constructor.
     * @param BlogRepository $blogRepository
     * @param BlogCommentRepository $blogCommentRepository
     */
    public function __construct(BlogRepository $blogRepository, BlogCommentRepository $blogCommentRepository)
    {
        $this->blogRepository = $blogRepository;
        $this->blogCommentRepository = $blogCommentRepository;
    }

    public function index()
    {
        return view("front.blog.index");
    }

    public function show($slug)
    {
        $blog = $this->blogRepository->getBySlug($slug);
        return view("front.blog.show", [
            "blog" => $this->blogRepository->getBySlug($slug),
            "comments" => $this->blogCommentRepository->allFrom($blog->id)
        ]);
    }
}
