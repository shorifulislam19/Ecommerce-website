@extends('user_template.layouts.template')
@section('main-content')
<h2>Final step to Place Your Orders</h2>
<div class="row">
    <div class="col-8">
        <div class="box_main">
           <h3> Product with send at-</h3>
           <p>City/Village Name-{{$shipping_address->city_name  }}</p>
           <p>Postal Code-{{$shipping_address->postal_code  }}</p>
           <p>Phone Number-{{$shipping_address->phone_number  }}</p>

        </div>
    </div>

        <div class="col-4">
        <div class="box_main">
            <h3> Your Final Products are -</h3>

             <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
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
                            </tr>
                               @php
                            $total = $total + $items->price;
                        @endphp
                        @endforeach
                         @if ($total >0)
                        <tr>
                            <td></td>
                            <td>Price</td>
                            <td>{{ $total }}</td>
                          
                        </tr>
                         @endif
                    </table>
                </div>

        </div>
    </div>
        <form action="" method="post">
        @csrf
        <input type="submit" value="Cancle order" class="btn btn-danger  mr-3">
    </form>
        <form action="{{ route('place_order') }}" method="post">
        @csrf
        <input type="submit" value="Place order" class="btn btn-primary">
    </form>
</div>

@endsection