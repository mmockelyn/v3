<?php
namespace App\Repository\Blog;

use App\Model\Blog\BlogComment;

class BlogCommentRepository
{
    /**
     * @var BlogComment
     */
    private $blogComment;

    /**
     * BlogCommentRepository constructor.
     * @param BlogComment $blogComment
     */

    public function __construct(BlogComment $blogComment)
    {
        $this->blogComment = $blogComment;
    }

    /**
     * @param int $article_id
     * @return mixed
     */
    public function allFrom(int $article_id)
    {
        return $this->blogComment->newQuery()
            ->where('blog_id', $article_id)
            ->published()
            ->orderBy('updated_at', 'desc')
            ->get()
            ->load('user');
    }

    /**
     * @param int $article_id
     * @param int $user_id
     * @param string $comment
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public function create(int $article_id, int $user_id, $comment)
    {
        return $this->blogComment->newQuery()
            ->create([
                "blog_id"   => $article_id,
                "user_id"   => $user_id,
                "comment"   => $comment
            ])->load('user');

    }

    public function getLast()
    {
        return $this->blogComment->newQuery()
            ->get()->last()->load('user');
    }

    public function getLastForUser($limit = null)
    {
        return $this->blogComment->newQuery()
            ->where('user_id', auth()->user()->id)
            ->orderBy('updated_at', 'asc')
            ->limit($limit)
            ->get();
    }

    public function delete($comment_id)
    {
        return $this->blogComment->newQuery()
            ->find($comment_id)
            ->delete();
    }

    public function all($limit = null)
    {
        return $this->blogComment->newQuery()
            ->limit($limit)
            ->orderByDesc('updated_at')
            ->get();
    }

    public function allFromArticle($article_id, $limit = null)
    {
        return $this->blogComment->newQuery()
            ->where('blog_id', $article_id)
            ->limit($limit)
            ->orderByDesc('updated_at')
            ->get();
    }

    public function get($comment_id)
    {
        return $this->blogComment->newQuery()
            ->find($comment_id);
    }

    public function publish($comment_id)
    {
        return $this->get($comment_id)->update([
            "state" => 1,
            "updated_at" => now()
        ]);
    }

    public function unpublish($comment_id)
    {
        return $this->get($comment_id)->update([
            "state" => 0,
            "updated_at" => now()
        ]);
    }

}

