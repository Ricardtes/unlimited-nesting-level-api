<?php

namespace Tests\Feature;

use App\Models\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function textRequiresComment()
    {

        $this->json('POST', 'api/v1/comments')
            ->assertStatus(422)
            ->assertJson([
                'comment' => ['The comment field is required.'],
            ]);
    }

    public function testsCreateCommentsWithoutChildren()
    {

         $data = [
             'comment' => 'asdfsa',
             'pid' => null,
         ];

        $this->post(route('comments.store'), $data)
            ->assertStatus(201)
            ->assertJsonFragment($data);
    }

    public function testsCommentDeletedCorrectly()
    {
        $comment = Comment::class->create([
            'comment' => 'First comment',
            'pid' => null,
        ]);

        $this->json('DELETE', '/api/v1/comments/' . $comment->id, [])
            ->assertStatus(204);
    }

}
