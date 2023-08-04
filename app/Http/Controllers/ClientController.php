<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
   public function CategoryPage($id){
    $category = Category::findOrFail($id); 
    $products = Product::where('product_category_id',$id)->latest()->get();
    return view('user_template.category',compact('category', 'products'));
   }  
    public function SingleProduct($id){
        $product = Product::findOrFail($id);
        $subcat_id = Product::where('id',$id)->value('product_subcategory_id');
        $related_products = Product::where('product_subcategory_id', $subcat_id)->latest()->get();
    return view('user_template.product',compact('product', 'related_products'));
   }
      public function AddToCart(){
        $userid = Auth::id();
        $cart_items = Cart::where('user_id', $userid)->get();
    return view('user_template.add_to_cart',compact('cart_items'));
   }
      public function shipping_address(){
    return view('user_template.shipping_address');
   }     
       public function add_shipping_address(Request $request){
    $validated = $request->validate([
      'phone_number' => 'required',
      'city_name' => 'required',
      'postal_code' => 'required',
    ]);

        ShippingInfo::insert([
          'user_id'=>Auth::id(),
          'phone_number' =>$request->phone_number,
          'city_name' =>$request->city_name,
          'postal_code' =>$request->postal_code,
        ]);
        return redirect()->route('checkout');
   }      
   public function Checkout(){
    $userid = Auth::id();
    $cart_items = Cart::where('user_id', $userid)->get();
    $shipping_address = ShippingInfo::where('user_id', $userid)->first();
    return view('user_template.checkout' ,compact('cart_items', 'shipping_address'));
   }
      public function place_order(){
    $userid = Auth::id();
    $shipping_address = ShippingInfo::where('user_id', $userid)->first();
    $cart_items = Cart::where('user_id', $userid)->get();
    foreach($cart_items as $item){
      Order::insert([
        'userid' =>$userid,
        'shipping_phonenumber' => $shipping_address->phone_number,
        'shipping_city' => $shipping_address->city_name,
        'shipping_postalcode' => $shipping_address->postal_code,
        'product_id' => $item->product_id,
        'quantity' => $item->quantity,
        'total_price' => $item->price,
      ]);
      $id = $item->id;
      Cart::findOrFail($id)->delete();
    }
    return redirect()->route('pending_orders')->with('message', 'Your Order has Been Placed Successfully!!');
   } 
      public function user_profile(){
    return view('user_template.user_profile');
   }
    public function pending_orders()
    {
      $pending_orders = Order::where('status','pending')->latest()->get();
        return view('user_template.pending_orders',compact('pending_orders'));
    }
    public function history()
    {
        return view('user_template.history');
    }
    public function add_product_to_cart(Request $request){
      $product_price =$request->price;
      $quantity =$request->quantity;
      $price = $product_price*$quantity;
        Cart::insert([
            'product_id' =>$request->product_id,
            'user_id' =>Auth::id(),
            'quantity' =>$request->quantity,
            'price' => $price,
        ]);
        return redirect()->route('add_to_cart')->with('message', 'Your item add to cart successfully!!');
    }
      public function new_release(){
    return view('user_template.new_release');
   }
      public function todays_deal(){
    return view('user_template.todays_deal');
   }
      public function customer_service(){
    return view('user_template.customer_service');
   }  
       public function remove_cart_item($id){
        Cart::findOrFail($id)->delete();
    return redirect()->route('add_to_cart')->with('message', 'Your item removed to cart successfully!!');
   }

}
