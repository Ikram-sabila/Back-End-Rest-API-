<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        return response()->json(Category::all());
    }

    public function store(Request $request) {
        $category = Category::create($request->all());
        return response()->json($category, 201);
    }

    public function show($id){
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message'=>'Category Not Found'], 404);
        }

        return response()->json($category);
    }

    public function update(Request $request, $id){
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message'=>'Category Not Found'], 404);
        }

        $category->update([
            'nama'=>$request->nama
        ]);
    }

    public function destroy($id){
        Category::destroy($id);
        return response()->json(null, 204);
    }
}
