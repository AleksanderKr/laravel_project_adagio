@extends('users.layout')
@section('content')

<br />
<div class="card" style="margin: 20px; width: 83%; margin: auto;">
    <div class="card-header">
        Dane użytkownika
        <button type="button" class="btn btn-primary" onclick="window.location='{{ url("users/") }}'" style="margin-left: 20px;"> Back to index </button>
    </div>
    <div class="card-body">
        <h5 class="card-title">Nazwa użytkownika: {{ $users->username }}</h5><br />
        <p class="card-text">Imię: {{ $users->first_name }}</p>
        <p class="card-text">Nazwisko: {{ $users->last_name }}</p>
        <p class="card-text">Nr telefonu: {{ $users->telephone }}</p>
        <p class="card-text">NIP: {{ $users->NIP }}</p>
        <p class="card-text">Email: {{ $users->email }}</p>
    </div>
</div>

<!--                        cart                  -->

<div class="container">
    <br />
    <h4 style="margin-left: 15px"> Koszyk użytkownika: {{ $users->username }} </h4>
    
        <div class="row">
            @foreach ($cart as $user_cart)
            <div class="col">
                <div class="card" style="margin: 20px;">
                    <div class="card-header">Id zamówienia: {{ $user_cart->ord_id }}</div>
                    <div class="card-body">
                        <p>Ilość {{ $user_cart->quantity }}</p>
                        <p>Imię {{ $user_cart->item_name }}</p>
                        <p>Id oferty {{ $user_cart->offer_id }}</p>
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
    <h4 style="margin-left: 15px"> Oferty sprzedaży użytkownika: {{ $users->username }} </h4>
    
        <div class="row">
            @foreach ($offers as $offer)
            <div class="col">
                <div class="card" style="margin: 20px;">
                    <div class="card-header">Id oferty: {{ $offer->id }}</div>
                    <div class="card-body">
                        <p>Imię: {{ $offer->item_name }}</p>
                        <p>Kategoria: {{ $offer->category }}</p>
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
    <h4 style="margin-left: 15px"> Adresy użytkownika: {{ $users->username }}</h4>
    
        <div class="row">
            @foreach ($user_addresses as $address)
            <div class="col">
                <div class="card" style="margin: 20px;">
                    <div class="card-header">Id adresu: {{ $address->id }}</div>
                    <div class="card-body">
                        <p>Kod pocztowy: {{ $address->zip_code }}</p>
                        <p>Miejscowość: {{ $address->locality }}</p>
                        <p>Ulica i nr domu:  {{ $address->street_and_house_nr }}</p>
                        <p>Państwo: {{ $address->country }}</p>

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

