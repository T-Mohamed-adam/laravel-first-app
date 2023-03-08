<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
       return Product::all();
    }

    public function store(Request $request)
    {
      
      $formfields =  $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'price' => 'required',
            'rate' => 'nullable',
            'description' => 'required',
            'category' => 'required',
            'calories' => 'required'
        ]);
        $file_name = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $file_name);
        $path = "images/$file_name";
        
        return Product::create([
            'name' => $request->name,
            'rate' => $request->rate,
            'price' => $request->price,
            'description' => $request->description,
            'category' => $request->category,
            'calories' => $request->calories,
            'image' => $path
        ]);
        // if ($request->hasFile('image')) {
        //     $formfields['image'] = $request->file('image')->store('images', 'public'); 
        // }
        // return Product::create($formfields);
        
    }

    public function show($id)
    {
        return Product::find($id);
    }

    public function update(Request $request, $id)
    {
        $formfields =  $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'price' => 'required',
            'rate' => 'nullable',
            'description' => 'required',
            'category' => 'required',
            'calories' => 'required'
        ]);
        $file_name = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $file_name);
        $path = "images/$file_name";


        $product = Product::find($id);
        $product->update(
            [
                'name' => $request->name,
                'rate' => $request->rate,
                'price' => $request->price,
                'description' => $request->description,
                'category' => $request->category,
                'calories' => $request->calories,
                'image' => $path
            ]
        );
        return $product;
    }
    
    public function delete($id)
    {

        return Product::destroy($id);
    }

    public function search($name)
    {
        return Product::where('name', 'like', '%'.$name.'%')->get();
    }
}
