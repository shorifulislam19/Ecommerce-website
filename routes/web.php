<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('user_template.layouts.template');
// });

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});
//  for authentication 
Route::middleware(['auth', 'role:user'])->group(
    function () {
Route::controller(ClientController::class)->group(function () {
    Route::get('/add_to_cart', 'AddToCart')->name('add_to_cart');
    Route::post('/add_product_to_cart', 'add_product_to_cart')->name('add_product_to_cart');
    Route::get('/shipping_address', 'shipping_address')->name('shipping_address');
    Route::post('/add_shipping_address', 'add_shipping_address')->name('add_shipping_address');
    Route::post('/place_order', 'place_order')->name('place_order');
    Route::get('/checkout', 'Checkout')->name('checkout');
    Route::get('/user_profile', 'user_profile')->name('user_profile');
    Route::get('/user_profile/pending_orders', 'pending_orders')->name('pending_orders');
    Route::get('/user_profile/history', 'history')->name('history');
    Route::get('/todays_deal', 'todays_deal')->name('todays_deal');
    Route::get('/customer_service', 'customer_service')->name('customer_service');
    Route::get('/remove_cart_item/{id}', 'remove_cart_item')->name('remove_cart_item');
});
    }
);
Route::controller(ClientController::class)->group(function () {
    Route::get('/category/{id}/{slug}', 'CategoryPage')->name('category');
    Route::get('/product_details/{id}/{slug}', 'SingleProduct')->name('single_product');
    // Route::get('/add_to_cart', 'AddToCart')->name('add_to_cart');
    // Route::get('/checkout', 'Checkout')->name('checkout');
    // Route::get('/user_profile', 'user_profile')->name('user_profile');
    Route::get('/new_release', 'new_release')->name('new_release');
    // Route::get('/todays_deal', 'todays_deal')->name('todays_deal');
    // Route::get('/customer_service', 'customer_service')->name('customer_service');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth' ,'role:user'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(
    function () {

        Route::controller(DashboardController::class)->group(function () {
            Route::get('/admin/dashboard', 'index')->name('dashboard');
            
        });
    });

Route::controller(CategoryController::class)->group(function () {
    Route::get('/admin/all_category', 'index')->name('all_category');
    Route::get('/admin/add_category', 'add_category')->name('add_category');
    Route::post('/admin/store_category', 'store_category')->name('store_category');
    Route::get('/admin/edit_category/{id}', 'edit_category')->name('edit_category');
    Route::post('/admin/update_category', 'update_category')->name('update_category');
    Route::get('/admin/delete_category/{id}', 'delete_category')->name('delete_category');
});
Route::controller(SubCategoryController::class)->group(function () {
    Route::get('/admin/all_subcategory', 'index')->name('all_subcategory');
    Route::get('/admin/add_subcategory', 'add_subcategory')->name('add_subcategory');
    Route::post('/admin/store_subcategory', 'store_subcategory')->name('store_subcategory');
    Route::get('/admin/delete_subcategory/{id}', 'delete_subcategory')->name('delete_subcategory');
});
Route::controller(ProductController::class)->group(function () {
    Route::get('/admin/all_product', 'index')->name('all_product');
    Route::get('/admin/add_product', 'add_product')->name('add_product');
    Route::post('/admin/store_product', 'store_product')->name('store_product');
    Route::get('/admin/edit_product_image/{id}', 'edit_product_image')->name('edit_product_image');
    Route::get('/admin/edit_product/{id}', 'edit_product')->name('edit_product');
    Route::get('/admin/delete_product/{id}', 'delete_product')->name('delete_product');
    Route::post('/admin/update_product_image', 'update_product_image')->name('update_product_image');
    Route::post('/admin/update_product_image', 'update_product_image')->name('update_product_image');
});
Route::controller(OrderController::class)->group(function () {
    Route::get('/admin/pending_order', 'index')->name('pending_order');
    // Route::get('/admin/add_product', 'add_product')->name('add_product');
});

// Route::get('/userprofile' , [DashboardController::class , 'index']);



require __DIR__.'/auth.php';
