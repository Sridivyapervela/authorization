<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        $comments = $post
            ->comments()
            ->latest()
            ->get();
        return response()->json([
            "success" => true,
            "data" => $comments,
        ]);
    }
    public function store(CommentRequest $request, Post $post)
    {
        $comment = $post->comments()->create([
            "body" => $request->body,
            "user_id" => Auth::id(),
        ]);
        if ($comment) {
            return response()->json([
                "success" => true,
                "data" => $comment->toArray(),
            ]);
        } else {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Comment not added",
                ],
                500
            );
        }
    }
    public function update(
        CommentRequest $request,
        Post $post,
        Comment $comment
    ) {
        $currentComment = $post
            ->comments()
            ->find($comment)
            ->first();
        if (!$currentComment) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Comment not found",
                ],
                400
            );
        }
        $updated = $currentComment->update($request->all());
        if ($updated) {
            return response()->json([
                "success" => true,
                "data" => $currentComment,
            ]);
        } else {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Comment can not be updated",
                ],
                500
            );
        }
    }

    public function destroy(Post $post, Comment $comment)
    {
        $comment = $post
            ->comments()
            ->find($comment)
            ->first();
        if (!$comment) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Comment not found",
                ],
                400
            );
        }
        if ($comment->delete()) {
            return response()->json([
                "success" => true,
                "message" => "Comment is deleted",
            ]);
        } else {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Comment can not be deleted",
                ],
                500
            );
        }
    }
}
