@extends('master')
@section("content")
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <img class="detail-img" src="{{$details['gallery']}}" alt="">
        </div>
        <div class="col-sm-6">
            <a href="/">Go Back</a>
            <h2>Name: {{$details['name']}}</h2>
            <h3>Price: {{$details['price']}}</h3>
            <h3>Model: {{$details['description']}}</h3>
            <h3>Category: {{$details['category']}}</h3>
            <br> <br>

            <div id="error_message">
                
            </div>

            <form action="/add-to-cart" method="post">
                @csrf
                <input type="hidden" name="product_id" value="{{$details['id']}}">
                <input type="text" name="amount" id="qty" value="1" onchange="validateAmount(this.value, {{$details['id']}})"> <br>
                <button class="btn btn-primary">Add to Cart</button>

            </form>
            <br>
            <button class="btn btn-success">Buy Now</button>
        </div>
    </div>
</div>
@endsection