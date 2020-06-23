<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Services\CommentService\CommentService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CommentsRequest;

class CommentsController extends Controller
{

    /**
     * @var CommentService
     */
    private $comment;

    public function __construct(CommentService $comment)
    {
        $this->comment = $comment;
    }


    /**
     * @return JsonResponse
     */
    public function index()
    {

        // Get all parent top level category
        $comments = Comment::where('pid', null)->get();

        // Get nestable data
        $nestable = Comment::nestable($comments);

        return new JsonResponse([
            'comments' => $nestable,
        ]);
    }






//    /**
//     * @param $id
//     * @return JsonResponse
//     */
//    public function getComment($id)
//    {
//
//        return new JsonResponse([
//            'editComment' => $this->comment->find($id)
//        ]);
//    }

    /**
     * @param CommentsRequest $request
     * @return JsonResponse
     */
    public function store(CommentsRequest $request)
    {
        $comment = $this->comment->create($request->only(['comment', 'pid']));

        return new JsonResponse($comment, 201);
    }

    /**
     * @param CommentsRequest $request
     * @param $id
     * @return JsonResponse
     */
    public function update(CommentsRequest $request, $id)
    {
        $comment = $this->comment->find($id);
        $comment->comment = $request->comment;
        $comment->save();

        return new JsonResponse([
            'result' => $comment,
        ]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $comment = $this->comment->find($id)->delete();

        return new JsonResponse([
            'result' => $comment,
        ], 204);
    }
}
