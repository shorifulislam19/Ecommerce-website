@extends('admin.layouts.templates')
@section('page_title')
    Add Product  page
@endsection
@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span> Add Product</h4>
        <div class="row">
            <div class="col-md-12">
                                <!-- Basic Layout -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Add new Product</h5>
                      <small class="text-muted float-end">Input Information</small>
                    </div>
                    <div class="card-body">
                   @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                   @endif
                      <form action="{{ route('store_product') }}" method="POST" enctype="multipart/form-data" >
                        @csrf
                        <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name"> Product Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Electronics" />
                          </div>
                        </div>
                         <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name"> Product Price</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" name="price" id="price" placeholder="price" />
                          </div>
                        </div>

                           <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name"> Product Quantity</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="quantity" />
                          </div>
                        </div>
                         <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name"> Product Long Description</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" name="product_long_des" id="product_long_des" cols="30" rows="5"></textarea>
                          </div>
                        </div>
                          <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name"> Product Short Description</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" name="product_short_des" id="product_short_des" cols="30" rows="5"></textarea>
                          </div>
                        </div>
                        

                         <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Select Category</label>
                          <div class="col-sm-10">
                          <select id="product_category_id" name="product_category_id" class="form-select">
                            <option selected>Select Product Category</option>
                            @foreach ($categories as $category )
                          <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                          </div>
                            </div>

                            
                         <div class="row mb-3">
                        <label class="col-sm-2 col-form-label" for="basic-default-name">Select Product Sub Category</label>
                          <div class="col-sm-10">
                          <select id="product_subcategory_id" name="product_subcategory_id" class="form-select">
                            <option selected>Open this select menu</option>
                            @foreach ($subcategories as $subcategory )
                          <option value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                            @endforeach
                        </select>
                          </div>
                            </div>
                           
                            <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name"> Product Image</label>
                          <div class="col-sm-10">
                             <input name="product_image" id="product_image" class="form-control" type="file" id="formFile" />
                          </div>
                        </div>

                        </div>
                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Add Sub Category</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
   
@endsection