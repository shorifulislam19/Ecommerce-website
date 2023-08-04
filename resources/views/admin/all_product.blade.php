@extends('admin.layouts.templates')
@section('page_title')
    All Product page
@endsection
@section('content')
   <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span> All Product</h4>
    <div class="row">
        <div class="col-md-12">
             <div class="card">
                <h5 class="card-header">Available All Product Information</h5>
                    @if ('session'()->has('message'))
                  <div class="alert alert-success">
                        {{ session()->get('message') }}
                  </div>
                  @endif
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead class="table-light">
                      <tr>
                        <th>Id</th>
                        {{-- <th>Category Name</th> --}}
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                         @php
                      $sl = 1; 
                       @endphp
                      @foreach ($products as $product )
                         <tr>
                         <td>{{ $sl }}</td>
                         <td>{{ $product->product_name }}</td>
                         <td>
                          <img src="{{ asset($product->product_image) }}" style="height: 100px">
                          <br>
                          <a href="{{ route('edit_product_image',$product->id) }}" class="btn btn-primary">Update Image</a>
                         </td>
                         <td>{{ $product->price }}</td>
                         <td>
                            <a href="{{ route('edit_product',$product->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('delete_product',$product->id) }}" onclick="return confirm('are you sure want to delete?')" class="btn btn-danger">Delete</a>
                         </td>
                      </tr>
                           @php
                                  $sl++;
                              @endphp
                      @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
        </div>
    </div>
   </div>
   
@endsection