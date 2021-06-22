<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->posts;

        return response()->json([
            "success" => true,
            "data" => $posts,
        ]);
    }

    public function show($id)
    {
        $post = auth()
            ->user()
            ->posts()
            ->find($id);

        if (!$post) {
            return response()->json([
                "success" => false,
                "message" => "Post not found",
            ]);
        }

        return response()->json([
            "success" => true,
            "data" => $post->toArray(),
        ]);
    }

    public function store(PostRequest $request)
    {
        $post = auth()
            ->user()
            ->createPost($request);
        if ($post) {
            return response()->json([
                "success" => true,
                "data" => $post->toArray(),
            ]);
        } else {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Post not added",
                ],
                500
            );
        }
    }

    public function update(PostRequest $request, $id)
    {
        \Log::info("update");
        $post = auth()
            ->user()
            ->posts()
            ->find($id);

        if (!$post) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Post not found",
                ],
                400
            );
        }

        $updated = $post->fill($request->all())->save();

        if ($updated) {
            return response()->json([
                "success" => true,
                "data" => $post,
            ]);
        } else {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Post can not be updated",
                ],
                500
            );
        }
    }

    public function destroy($id)
    {
        $post = auth()
            ->user()
            ->posts()
            ->find($id);

        if (!$post) {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Post not found",
                ],
                400
            );
        }

        if ($post->delete()) {
            return response()->json([
                "success" => true,
            ]);
        } else {
            return response()->json(
                [
                    "success" => false,
                    "message" => "Post can not be deleted",
                ],
                500
            );
        }
    }
}
