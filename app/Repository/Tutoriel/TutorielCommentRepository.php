<?php

namespace App\Repository\Tutoriel;

use App\Model\Tutoriel\TutorielComment;

class TutorielCommentRepository
{
    /**
     * @var TutorielComment
     */
    private $tutorielComment;

    /**
     * TutorielCommentRepository constructor.
     * @param TutorielComment $tutorielComment
     */

    public function __construct(TutorielComment $tutorielComment)
    {
        $this->tutorielComment = $tutorielComment;
    }

    public function allFrom($tutoriel_id)
    {
        return $this->tutorielComment->newQuery()
            ->where('tutoriel_id', $tutoriel_id)
            ->where('published', 1)
            ->orderBy('published_at', 'desc')
            ->get()
            ->load('user');
    }

    public function getLastForUser($int = null)
    {
        return $this->tutorielComment->newQuery()
            ->where('user_id', auth()->user()->id)
            ->limit($int)
            ->orderBy('published_at', 'desc')
            ->get()
            ->load('tutoriel');
    }

    public function create($tutoriel_id, $id, $comment)
    {
        return $this->tutorielComment->newQuery()
            ->create([
                "tutoriel_id" => $tutoriel_id,
                "user_id" => $id,
                "content" => $comment,
                "published_at" => now()
            ]);
    }

    public function delete($comment_id)
    {
        return $this->tutorielComment->newQuery()
            ->find($comment_id)
            ->delete();
    }

}

