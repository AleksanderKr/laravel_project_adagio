@extends('users.layout')
@section('content')

<div class="card" style="margin: 20px;">
    <div class="card-header">
        Offer data
        <button type="button" class="btn btn-primary" onclick="window.location='{{ url("/") }}'" style="margin-left: 20px;"> Back to index </button>
    </div>
    <div class="card-body">
        <h5 class="card-title">Item name: {{ $offers->item_name }}</h5><br />
        <p class="card-text">Category: {{ $offers->category }}</p>
        <p class="card-text">Brand: {{ $offers->brand }}</p>
        <p class="card-text">Description: {{ $offers->description }}</p>
        <img src="{{ $offers->pictures }}" width ="40%" height="40%" alt="no image found" />
        <p class="card-text">Put up on: {{ $offers->put_up_on }}</p>
        <p class="card-text">Shipper: {{ $offers->shipper }}</p>
        <h5 class="card-title">Price: {{ $offers->price }} PLN </h5><br />
        <!-- request ustawienia order_id w tablicy `offers` na `user_id`    dodaj do koszyka -->
        <form action="/offers/{{ $offers->id }}/makeOrder" method="post">
            @csrf
            <button type="submit" class="btn btn-warning">Dodaj do koszyka</button>
        </form>
            
    </div>
</div>
opinie
@endsection