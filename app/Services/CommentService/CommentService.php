<?php

namespace App\Services\CommentService;

use App\Models\Comment;
use phpDocumentor\Reflection\Types\Collection;

class CommentService implements CommentServiceInterface
{
    /**
     * @var Comment
     */
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->comment->create($data);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->comment->find($id);
    }

}
