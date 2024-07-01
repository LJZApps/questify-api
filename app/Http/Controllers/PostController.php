<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class PostController extends Controller
{
    public function getAll()
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

    public function getSinglePost(int $id)
    {
        $post = Post::find($id);

        if (isNull($post)) {
            return response()->json(
                data: ["success" => false, "message" => "Post not found."],
                status: 404
            );
        }

        return response()->json($post);
    }

    public function createPost(Request $request)
    {
        $post = Post::create([
            'created_by' => 1,
            'text' => $request->input('text')
        ]);

        return response()->json($post, 201);
    }
}
