@extends('user_template.layouts.template')
@section('main-content')
<h2>Provide your Shipping Information</h2>

    <div class="row">
    <div class="col-12">
        <div class="box_main">
            <form action="{{ route('add_shipping_address') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" class="form-control" name="phone_number" placeholder="01xxxxxxxxx" required>
                </div>
                    <div class="form-group">
                    <label for="city_name">City/Village Name</label>
                    <input type="text" class="form-control" name="city_name" placeholder="Enter City Or VIllage name" required>
                </div>
                   <div class="form-group">
                    <label for="postal_code">Post COde</label>
                    <input type="text" class="form-control" name="postal_code" placeholder="Enter your POstal Code" required>
                </div>
                <input type="submit" class="btn btn-info" value="Save">
            </form>
        </div>
    </div>
</div>


@endsection