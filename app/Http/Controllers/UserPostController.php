<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\UserPost;
use App\Http\Resources\UserResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\UserPostResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserPostController extends Controller
{
    public function makelike(Request $request, $id){
        $UserPost = UserPost::find($id);
            $userId = Auth::id();
            $existingLike = UserPost::where('user_id', $userId)->where('post_id', $id)->first();
            if ($existingLike) {
                return response()->json(['message' => 'You have already liked this post']);
            } else {
                $UserPostData = [
                    'user_id' => $userId,
                    'post_id' => $id,
                    'liked' => 1
                ];
        
                UserPost::create($UserPostData);
                return response()->json(['message' => 'Liked Successfully']);
            }
        }

        public function makecomment(Request $request, $id){
            $UserPost = UserPost::find($id);
                $userId = Auth::id();
                    $UserPostData = [
                        'user_id' => $userId,
                        'post_id' => $id,
                        'comment' => $request->comment
                    ];
            
                    UserPost::create($UserPostData);
                    return response()->json(['message' => 'Comment Successfully']);
            }
}
