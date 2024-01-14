<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Http\Resources\UserResource;
use App\Http\Resources\PostResource;


class PostController extends Controller
{
    public function list()
    {
        $posts = Post::all();
        return PostResource::collection($posts);
    }

    public function show($id)
    {
        $post = Post::find($id);
    
        if ($post) {
            return new PostResource($post);
        } else {
            return response()->json(['error' => 'Post not found'], 404);
        }
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string',
        'author' => 'required|integer|exists:users,id',
        'categoyry_id' => 'required|integer|exists:categouries,id',
        'text' => 'required|string',
        'image' => 'required|string',
    ]);

    $post = Post::create([
        'title' => $validatedData['title'],
        'author' => $validatedData['author'],
        'categoyry_id' => $validatedData['categoyry_id'],
        'text' => $validatedData['text'],
        'image' => $validatedData['image'],
    ]);

    return response()->json(['message' => 'Post created successfully']);
}

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
    
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }
    
        $validatedData = $request->validate([
            'title' => 'string',
            'author' => 'integer|exists:users,id',
            'categoyry_id' => 'integer|exists:categouries,id',
            'text' => 'string',
            'image' => 'string',
        ]);
    
        $post->update($validatedData);
    
        return response()->json(['message' => 'Post updated successfully']);
    }

    public function delete($id)
    {
        $post = Post::find($id);
    
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }
    
        $post->delete();
    
        return response()->json(['message' => 'Post deleted successfully']);
    }

    
}
