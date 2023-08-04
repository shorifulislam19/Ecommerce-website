@extends('admin.layouts.templates')
@section('page_title')
    Edit Product  Image
@endsection
@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span> Edit Image</h4>
        <div class="row">
            <div class="col-md-12">
                                <!-- Basic Layout -->
                <div class="col-xxl">
                  <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h5 class="mb-0">Edit new Image</h5>
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
                      <form action="{{ route('update_product_image') }}" method="POST" enctype="multipart/form-data" >
                        @csrf


                            <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name"> Previous Image</label>
                          <div class="col-sm-10">
                             <img src="{{ asset($product_info->product_image) }}" style="height: 200px" alt="">
                          </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $product_info->id }}">
                            <div class="row mb-3">
                          <label class="col-sm-2 col-form-label" for="basic-default-name"> Upadte New Image</label>
                          <div class="col-sm-10">
                             <input name="product_image" id="product_image" class="form-control" type="file" id="formFile" />
                          </div>
                        </div>

                        </div>
                        <div class="row justify-content-end">
                          <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Update Image</button>
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