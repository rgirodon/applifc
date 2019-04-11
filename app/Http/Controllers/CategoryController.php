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
}
