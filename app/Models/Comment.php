<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['pid', 'comment'];


    public function childs()
    {
        return $this->hasMany(Comment::class, 'pid', 'id');
    }


    public function parent() {
        return $this->belongsTo(self::class, 'id');
    }

    // for first level child this will works enough
    public function children() {
        return $this->hasMany(self::class, 'pid');
    }

    // and here is the trick for nestable child.
    public static function nestable($comments) {
        foreach ($comments as $comment) {

            if (!$comment->children->isEmpty()) {
                $comment->children = self::nestable($comment->children);

            }
        }

        return $comments;
    }
}
