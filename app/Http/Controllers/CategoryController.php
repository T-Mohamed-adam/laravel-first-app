<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
       return Category::all();
    }

    public function store (Request $request){

        $formfields =  $request->validate(
            [
            'category' => 'required|unique:categories,category'
            ]
    );

            return Category::create($formfields);


    }
    
}
