@extends('user_template.layouts.template')
@section('main-content')
<h2>add to cart page</h2>
       @if ('session'()->has('message'))
     <div class="alert alert-success">
      {{ session()->get('message') }}
       </div>
     @endif

     <div class="row">
        <div class="col-12">
            <div class="box_main">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        @php
                            $total =0;
                        @endphp
                        @foreach ($cart_items as $items )

                            <tr>
                                @php
                                    $product_name = App\Models\Product::where('id', $items->product_id)
                                                 ->value('product_name');  
                                   $img = App\Models\Product::where('id', $items->product_id)
                                                 ->value('product_image');
                                @endphp
                                <td><img src="{{ asset($img) }}" style="height: 50px" alt=""></td>
                                <td>{{ $product_name }}</td>
                                <td>{{ $items->quantity }}</td>
                                <td>{{ $items->price }}</td>
                                <td><a href="{{ route('remove_cart_item',$items->id) }}" onclick="return confirm('sure want to delete this item?')" class="btn btn-warning">Remove</a></td>
                            </tr>
                               @php
                            $total = $total + $items->price;
                        @endphp
                        @endforeach
                         @if ($total >0)
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Price</td>
                            <td>{{ $total }}</td>
                            <td><a href="{{ route('shipping_address') }}" class="btn btn-primary">Checkout</a></td> 
                          
                        </tr>
                         @endif
                    </table>
                </div>
            </div>
        </div>
     </div>

@endsection