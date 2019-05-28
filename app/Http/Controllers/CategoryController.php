<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Club;

class CategoryController extends Controller
{
    public function index() {
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        return view('category.list')->with('categories', $categories);
    }
    
    public function api_index() {
        
        return Category::retrieveCategoriesForDefaultClub();
    }
    
    public function edit($id) {
        
        $category = Category::find($id);
        
        return view('category.edit')->with('category', $category);
    }
    
    public function editAll() {
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        return view('category.editAll')->with('categories', $categories);
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
    
    public function updateAll(Request $request) {
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        foreach ($categories as $category) {
        
            $request->validate([
                'label_'.$category->id => 'bail|required|max:255',
                'starts_at_'.$category->id => 'bail|nullable|date',
                'ends_at_'.$category->id => 'bail|nullable|date',
                'sex_'.$category->id => 'bail|required',
            ]);
        }
        
        
        foreach ($categories as $category) {
            
            $category->label = $request->input('label_'.$category->id);
            
            $category->starts_at = $request->input('starts_at_'.$category->id);
            
            $category->ends_at = $request->input('ends_at_'.$category->id);
            
            $category->sex = $request->input('sex_'.$category->id);
            
            $category->save();
        }
        
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
