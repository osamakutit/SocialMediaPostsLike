<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Http\Resources\UserResource;
use App\Http\Resources\PostResource;


class PostController extends Controller
{
    public function list()
    {
        //if (Auth::user()->isAdmin()) {
            $posts = Post::all();
        //}
        // else{
        //     $userId = Auth::id();
        //     $posts = Post::where('author', $userId)->get();
        // }
        return PostResource::collection($posts);
    }

    public function mine()
    {
        if (Auth::user()->isAdmin()) {
            $posts = Post::all();
        }
         else{
             $userId = Auth::id();
             $posts = Post::where('author', $userId)->get();
         }
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

    $rules = [
        'title' => 'required|string',
        'category_id' => 'required|integer|exists:categories,id',
        'text' => 'required|string',
        'image' => 'required|string',
    ];
    
    if (Auth::user()->isAdmin()) {
        $rules['author'] = 'required|integer|exists:users,id';
    }
    
    $validatedData = $request->validate($rules);

    $userId = Auth::id();
    $postData = [
        'title' => $validatedData['title'],
        'category_id' => $validatedData['category_id'],
        'text' => $validatedData['text'],
        'image' => $validatedData['image'],
    ];

    if (Auth::user()->isAdmin()) {
        $postData['author'] = $validatedData['author'];
    } else {
        $postData['author'] = $userId;
    }
    $post = Post::create($postData);

    return response()->json(['message' => 'Post created successfully']);
}

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
    
        if (!$post) {
            return response()->json(['error' => 'Post not found'], 404);
        }
    
        $rules = [
        'title' => 'required|string',
        'category_id' => 'required|integer|exists:categories,id',
        'text' => 'required|string',
        'image' => 'required|string',
        ];

        if (Auth::user()->isAdmin()) {
            $rules['author'] = 'required|integer|exists:users,id';
        }
        $validatedData = $request->validate($rules);

        $userId = Auth::id();

        $authorPost = Post::where('id', $id)
        ->pluck('author')
        ->first();

        $authorAcc = Post::where('author', $userId)
        ->pluck('author')
        ->first();

        if (Auth::user()->isAdmin()) {
            $post->update($validatedData);
            return response()->json(['message' => 'Post updated successfully']);
        }
        else{
            if ($authorPost === $authorAcc){
                $post->update($validatedData);
                return response()->json(['message' => 'Post updated successfully']);
            }
            else{
                return response()->json(['error' => 'Post not authorized'], 403);
            }
        }
    }
    

    public function delete($id = null)
    {
        if (Auth::user()->isAdmin()) {
            $post = Post::find($id);
        }
        else{
            $userId = Auth::id();
            $post = Post::where('author', $userId)->where('id',$id)->first();
        }
        
         if (!$post) {
             return response()->json(['error' => 'Post not found'], 404);
         }
    
         $post->delete();
    
         return response()->json(['message' => 'Post deleted successfully']);
    }

    
}
