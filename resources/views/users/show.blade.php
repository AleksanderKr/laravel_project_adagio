@extends('users.layout')
@section('content')

<br />
<div class="card" style="margin: 20px; width: 83%; margin: auto;">
    <div class="card-header">
        User data
        <button type="button" class="btn btn-primary" onclick="window.location='{{ url("users/") }}'" style="margin-left: 20px;"> Back to index </button>
    </div>
    <div class="card-body">
        <h5 class="card-title">Username : {{ $users->username }}</h5><br />
        <p class="card-text">First Name: {{ $users->first_name }}</p>
        <p class="card-text">Last Name: {{ $users->last_name }}</p>
        <p class="card-text">Telephone: {{ $users->telephone }}</p>
        <p class="card-text">NIP: {{ $users->NIP }}</p>
        <p class="card-text">Password: {{ $users->password }}</p>
        <p class="card-text">Salt: {{ $users->salt }}</p>
        <p class="card-text">Email: {{ $users->email }}</p>
    </div>
</div>

<!--                        cart                  -->

<div class="container">
    <br />
    <h4 style="margin-left: 15px"> Cart of: {{ $users->username }} </h4>
    
        <div class="row">
            @foreach ($cart as $user_cart)
            <div class="col">
                <div class="card" style="margin: 20px;">
                    <div class="card-header">Order id: {{ $user_cart->ord_id }}</div>
                    <div class="card-body">
                        <p>Quantity {{ $user_cart->quantity }}</p>
                        <p>Item name {{ $user_cart->item_name }}</p>
                        <p>Offer id {{ $user_cart->offer_id }}</p>
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                        </div>
                        
                    </div>
                </div>
            </div>
            @endforeach
    </div>
    <div class="row" style="float: right;" >{{ $cart->links() }}</div>
</div>

<!--                        offers                  -->

<div class="container">
    <br />
    <h4 style="margin-left: 15px"> Offers posted by: {{ $users->username }} </h4>
    
        <div class="row">
            @foreach ($offers as $offer)
            <div class="col">
                <div class="card" style="margin: 20px;">
                    <div class="card-header">Offer id: {{ $offer->id }}</div>
                    <div class="card-body">
                        <p>Item name: {{ $offer->item_name }}</p>
                        <p>Category: {{ $offer->category }}</p>
                        <img src="{{ $offer->pictures }}" width ="40%" height="40%" alt="no image found" />
                        <br />
                        <br />
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                        </div>
                        
                    </div>
                </div>
            </div>
            @endforeach
    </div>
    <div class="row" style="float: right;" >{{ $offers->appends(['addresses' => $user_addresses->currentPage()])->links() }}</div>
</div>

<!--                        addresses                  -->

<div class="container">
    <br />
    <h4 style="margin-left: 15px"> Addresses of: {{ $users->username }}</h4>
    
        <div class="row">
            @foreach ($user_addresses as $address)
            <div class="col">
                <div class="card" style="margin: 20px;">
                    <div class="card-header">Address id: {{ $address->id }}</div>
                    <div class="card-body">
                        <p>Zip code: {{ $address->zip_code }}</p>
                        <p>Locality: {{ $address->locality }}</p>
                        <p>Street and house nr:  {{ $address->street_and_house_nr }}</p>
                        <p>Country: {{ $address->country }}</p>

                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                        </div>
                        
                    </div>
                </div>
            </div>
            @endforeach
    </div>
    <div class="row" style="float: right;">{{ $user_addresses->appends(['offers' => $offers->currentPage()])->links() }}</div>
</div>

