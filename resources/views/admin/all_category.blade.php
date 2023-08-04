@extends('admin.layouts.templates')
@section('page_title')
   All Category page
@endsection
@section('content')
   <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span> All Category</h4>
    <div class="row">
        <div class="col-md-12">
             <div class="card">
                <h5 class="card-header">Available Category Information</h5>

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
                        <th>Category Name</th>
                        <th>Sub Category Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                       @foreach ($category as $categories )
                      <tr>
                         <td>{{ $categories->id }}</td>
                         <td>{{ $categories->category_name }}</td>
                         <td>{{ $categories->subcategory_count }}</td>
                         <td>{{ $categories->slug }}</td>
                         <td>
                            <a href="{{ route('edit_category',$categories->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('delete_category',$categories->id) }}" onclick="return confirm('are you sure want to delete?')" class="btn btn-danger">Delete</a>
                         </td>
                      </tr>
                         
                        @endforeach

                    </tbody>
                  </table>
                </div>
              </div>
        </div>
    </div>
   </div>
   
@endsection