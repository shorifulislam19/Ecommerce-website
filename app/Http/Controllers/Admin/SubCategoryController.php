<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $sub_category = SubCategory::latest()->get();
        return view('admin.all_subcategory',compact('sub_category'));
    }
    public function add_subcategory()
    {
        $categories = Category::latest()->get();
        return view('admin.add_subcategory',compact('categories'));
    }

    public function store_subcategory(Request $request)
    {
      $request->validate([
            'subcategory_name' => 'required|unique:sub_categories',
            'category_id'=>'required'
        ]);

        // $category = new Category();
        // $category->category_name = $request->category_name;
        $category_id = $request->category_id;
        $category_name = Category::where('id',$category_id)->value('category_name');

        SubCategory::insert([
            'subcategory_name' => $request->subcategory_name,
            'slug' => strtolower(str_replace('', '-', $request->subcategory_name)),
            'category_id'=> $category_id,
            'category_name'=>   $category_name

        ]);

        Category::where('id',$category_id)->increment('subcategory_count',1);

        return redirect()->route('all_subcategory')->with('message', 'Sub Category Added successfully!!');
    }
    public function delete_subcategory($id)
    {
        SubCategory::findOrFail($id)->delete();
        return redirect()->route('all_subcategory')->with('message', 'Sub Category Deleted successfully!!');
    }
}
