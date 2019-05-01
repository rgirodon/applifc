<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Club;

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
    
    public function create() {
        
        return view('category.create');
    }
    
    public function destroy(Request $request, $id) {
        
        try {        
            $category = Category::find($id);
            
            $category->delete();
        
            $request->session()->flash('delete_message_ok', 'Catégorie supprimée');
        }
        catch(\Exception $exception) {        
            
            $request->session()->flash('delete_message_ko', 'Impossible de supprimer cette catégorie');
        }
        
        return redirect()->route('categories');
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
    
    public function store(Request $request) {
        
        $request->validate([
            'label' => 'bail|required|max:255',
            'starts_at' => 'bail|nullable|date',
            'ends_at' => 'bail|nullable|date',
            'sex' => 'bail|required',
        ]);
        
        $club = Club::findDefaultClub();
        
        $category = new Category();
        
        $category->club()->associate($club);
        
        $category->label = $request->input('label');
        
        $category->starts_at = $request->input('starts_at');
        
        $category->ends_at = $request->input('ends_at');
        
        $category->sex = $request->input('sex');
        
        $category->save();
        
        return redirect()->route('categories');
    }
}
