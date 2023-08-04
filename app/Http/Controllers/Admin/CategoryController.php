<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::latest()->get();
        return view('admin.all_category',compact('category'));
    }
    public function add_category()
    {
        return view('admin.add_category');
    }

    public function store_category( Request $request){
        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        // $category = new Category();
        // $category->category_name = $request->category_name;

        Category::insert([
            'category_name' => $request->category_name,
            'slug' =>strtolower(str_replace('','-', $request->category_name)) 

        ]);

        return redirect()->route('all_category')->with('message','Category Added successfully!!');
        
    }

    public function edit_category($id){
        $category_info = Category::findOrFail($id);
        return view('admin.editcategory', compact('category_info'));
    }
    public function update_category(Request $request){
        $category_id =$request->category_id;

        $validated = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);

        // $category = new Category();
        // $category->category_name = $request->category_name;

        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'slug' => strtolower(str_replace('', '-', $request->category_name))

        ]);

        return redirect()->route('all_category')->with('message', 'Category Updated successfully!!');
    }
    public function delete_category($id){
        Category::findOrFail($id)->delete();
        return redirect()->route('all_category')->with('message', 'Category Deleted successfully!!');
    }

}
