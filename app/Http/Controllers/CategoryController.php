<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index() {
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        return view('categories')->with('categories', $categories);
    }
    
    public function edit($id) {
        
        $category = Category::find($id);
        
        return view('category.edit')->with('category', $category);
    }
    
    public function update(Request $request, $id) {
        
        $request->validate([
            'label' => 'bail|required|max:255',
            'starts_at' => 'bail|nullable|date',
            'ends_at' => 'bail|nullable|date',
            'sex' => 'bail|required',
        ]);
        
        $category = Category::find($id);
        
        $category->label = $request->input('label');
        
        $category->starts_at = $request->input('starts_at');
        
        $category->ends_at = $request->input('ends_at');
        
        $category->sex = $request->input('sex');
        
        $category->save();
        
        return redirect()->route('categories');
    }
}
