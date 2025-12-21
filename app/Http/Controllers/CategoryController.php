<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::get();
        return response()->json($category);  
    }

    public function show(Category $id){
        return response()->json($id);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ['required','string','max:255'],
            'description' => ['required','string']
        ]);

        $category = Category::create([
            'name' => $validate['name'],
            'description' => $validate['description']
        ]);

        return response()->json([
            'status' => true,
            'message' => 'True Operation',
            'data' => $category
        ]);
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => ['required','string','max:255'],
            'description' => ['required','string']
    ]);

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $validate['name'],
            'description' => $validate['description']
    ]);

        return response()->json([
            'status' => true,
            'message' => 'Updated Successfully',
            'data' => $category
        ]);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return response()->json([
            'status' => true,
            'message' => 'Deleted Successfully'
    ]);
}
}
