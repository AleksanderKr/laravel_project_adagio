@extends('users.layout')
@section('content')

<div class="card" style="margin: 20px;">
    <div class="card-header">
        Offer data
        <button type="button" class="btn btn-primary" onclick="window.location='{{ url("/") }}'" style="margin-left: 20px;"> Back to index </button>
    </div>
    <div class="card-body">
        <form action="" method="post">
            Payment<input type="text" />
            
            <button type="submit">Confirm Order</button>
        </form>
        
    </div>
</div>