<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Licence;
use Carbon\Carbon;
use App\Category;

class LicenceController extends Controller
{        
    public function index() {
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $licences =  Licence::where([
            ['starts_at', '<=', Carbon::now()],
            ['ends_at', '>', Carbon::now()],
        ])->get();
        
        return view('licences')
                ->with(compact('licences', 'categories'));
    }

    public function findByCategory($categoryId) {
        
        $selectedCategory = Category::find($categoryId);
        
        $categories = Category::retrieveCategoriesForDefaultClub();
        
        $licences =  Licence::where([
            ['category_id', '=', $categoryId],
            ['starts_at', '<=', Carbon::now()],
            ['ends_at', '>', Carbon::now()],
        ])->get();
        
        return view('licences')
                ->with(compact('licences', 'categories', 'selectedCategory'));
    }
}