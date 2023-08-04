@extends('admin.layouts.templates')
@section('page_title')
    Add Pending page
@endsection
@section('content')
    <div class="contain">
        <div class="card">
            <div class="card-title">Pending Order</div>
            <div class="card-body">
              
                    <table class="table">
                    <tr>
                        <th>User Id</th>
                        <th>Shipping Information</th>
                        <th>Product Id</th>
                        <th>Quantity</th>
                        <th>Total will Pay</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                          @foreach ($pending_orders as $order )
                          <tr>
                            <td>{{ $order->user_id }}</td>
                            <td>
                                <ul>
                                    <li>Phone Number:-{{  $order->shipping_phonenumber  }}</li>
                                    <li>Phone Number:-{{  $order->shipping_city  }}</li>
                                    <li>Phone Number:-{{  $order->shipping_postalcode  }}</li>
                                </ul>
                            </td>
                            <td>{{ $order->product_id }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td><a href="" class="btn btn-success">Approve Now</a></td>
                          </tr>
                         @endforeach
                    </table>
               
            </div>
        </div>
    </div>
   
@endsection