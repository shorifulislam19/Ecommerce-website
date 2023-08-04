@extends('admin.layouts.templates')
@section('page_title')
    All sub Category page
@endsection
@section('content')
   <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span> All SubCategory</h4>
    <div class="row">
        <div class="col-md-12">
             <div class="card">
                <h5 class="card-header">Available SubCategory Information</h5>
                
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
                        <th>Sub Category Name</th>
                        <th>Category</th>
                        <th>product</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      @php
                      $sl = 1; 
                       @endphp
                    @foreach ($sub_category as $subcategories )
                        <tr>
                         <td>{{ $sl  }}</td>
                         <td>{{$subcategories->subcategory_name  }}</td>
                         <td>{{$subcategories->category_name  }}</td>
                         <td>{{$subcategories->product_count  }}</td>
                         <td>
                            <a href="#" class="btn btn-primary">Edit</a>
                           <a href="{{ route('delete_category',$subcategories->id) }}" onclick="return confirm('are you sure want to delete?')" class="btn btn-danger">Delete</a>
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