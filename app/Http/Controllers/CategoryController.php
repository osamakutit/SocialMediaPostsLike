<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Http\Resources\UserResource;
use App\Http\Resources\PostResource;
use App\Http\Resources\CategoryResource;


class CategoryController extends Controller
{
    public function list()
    {
        $category = Category::all();
        return CategoryResource::collection($category);
    }

    public function show($id)
    {
        $category = Category::find($id);
    
        if ($category) {
            return new CategoryResource($category);
        } else {
            return response()->json(['error' => 'Category not found'], 404);
        }
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string',
        'category_id' => 'required|integer|exists:categories,id',
    ]);

    $category = Category::create([
        'name' => $validatedData['name'],
        'category_id' => $validatedData['category_id'],
    ]);

    return response()->json(['message' => 'Category created successfully']);
}

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
    
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
    
        $validatedData = $request->validate([
            'name' => 'string',
            'category_id' => 'integer|exists:categories,id',
        ]);
    
        $category->update($validatedData);
    
        return response()->json(['message' => 'Category updated successfully']);
    }

    public function delete($id)
    {
        $category = Category::find($id);
    
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }
    
        $category->delete();
    
        return response()->json(['message' => 'Category deleted successfully']);
    }

    
}
