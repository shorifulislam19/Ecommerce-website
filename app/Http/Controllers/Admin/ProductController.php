<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.all_product' , compact('products'));
    }
    public function add_product()
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        return view('admin.add_product',compact('categories', 'subcategories'));
    }
    public function store_product(Request $request){
        $request->validate([
            'product_name' => 'required|unique:products',
            'price' => 'required',
            'quantity' => 'required',
            'product_short_des' => 'required',
            'product_long_des' => 'required',
            'product_category_id' => 'required',
            'product_subcategory_id' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('product_image');
        $img_name = hexdec(uniqid()).'.'. $image->getClientOriginalExtension();
        $request->product_image->move(public_path('upload'), $img_name);
        $img_url = 'upload/' . $img_name;


        $category_id = $request->product_category_id;
        $subcategory_id = $request->product_subcategory_id;

        $category_name = Category::where('id', $category_id)->value('category_name');
        $subcategory_name = SubCategory::where('id', $subcategory_id)->value('subcategory_name');

                Product::insert([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'product_category_name' => $category_name,
            'product_subcategory_name' => $subcategory_name,
            'quantity' => $request->quantity,
            'product_short_des' => $request->product_short_des,
            'product_long_des' => $request->product_long_des,
            'product_category_id' => $request->product_category_id,
            'product_subcategory_id' => $request->product_subcategory_id,
            'product_image' =>  $img_url,
            'slug' => strtolower(str_replace('', '-', $request->product_name)),
        ]);

        Category::where('id', $category_id)->increment('product_count', 1);
        SubCategory::where('id', $subcategory_id)->increment('product_count', 1);

        return redirect()->route('all_product')->with('message', 'Product Added successfully!!');
    }

    public function edit_product_image($id){
        $product_info = Product::findOrFail($id);
        return view('admin.update_image',compact('product_info'));
    }

    public function update_product_image(Request $request){
        $request->validate([
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $id = $request->id;
        $image = $request->file('product_image');
        $img_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        $request->product_image->move(public_path('upload'), $img_name);
        $img_url = 'upload/' . $img_name;

       Product::findOrFail($id)->update([
            'product_image' =>  $img_url,
       ]);
        return redirect()->route('all_product')->with('message', 'Image Updated successfully!!');
    }
    public function edit_product(){
        
    }
    public function delete_product($id)
    {
        Product::findOrFail($id)->delete();
        return redirect()->route('all_product')->with('message', 'Product Deleted successfully!!');
    }
}
