@extends('users.layout')
@section('content')

<div class="card" style="margin: 20px;">
    <div class="card-header">
        Zamówienie
        <button type="button" class="btn btn-primary" onclick="window.location='{{ url("/") }}'" style="margin-left: 20px;"> Wróć do strony głównej </button>
    </div>
    <div class="card-body">
        
        <form action="/offers/{{ $order_id }}/finishOrder" method="post">
            <!-- hidden z danymi -->
            
            <input type="hidden" value="{{ $order_id }}">
            
            <button type="submit" class="btn btn-warning">Zamów</button>
        </form>
        
    </div>
</div>