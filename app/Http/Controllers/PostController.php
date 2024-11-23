<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class PostController extends Controller
{
    public function getAll(): JsonResponse
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        if ($posts->count() < 1) {
            return response()->json(
                [
                    "error_code" => "no_posts",
                    "error_message" => "No posts has been found."
                ],
                status: 404
            );
        }
        return response()->json($posts);
    }

    public function getSinglePost(int $id): JsonResponse
    {
        $post = Post::find($id);

        if (isNull($post)) {
            return response()->json([
                "error_message" => "Post not found."
            ], 404);
        }

        return response()->json($post);
    }

    public function createPost(Request $request): JsonResponse
    {
        $post = Post::create([
            'created_by' => auth()->user()->id,
            'text' => $request->input('text')
        ]);

        return response()->json($post, 201);
    }

    public function editPost(Request $request, int $id): JsonResponse
    {
        $post = (new \App\Models\Post)->find($id);

        if (isNull($post)) {
            return response()->json([
                "error_message" => "Post not found."
            ], 404);
        }

        $post->text = $request->input('text');
        $post->save();

        return response()->json(["success" => true]);
    }
}
