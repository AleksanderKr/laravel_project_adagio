@extends('layouts.app')
@section('content')

<div class="card" style="margin: 20px;">
    <div class="card-header">Dodaj ofertę</div>
    <div class="card-body">
        
        <form action="{{ url('offers') }}" method="post" enctype="multipart/form-data">
            @csrf
            <label>Nazwa przedmiotu</label><br />
            <input type="text" name="item_name" id="item_name" value="{{ old('item_name') }}" class="form-control"><br />

            <label>Kategoria</label><br />
            <input type="text" name="category" id="category" value="{{ old('category') }}" class="form-control"><br />
            
            <label>Producent</label><br />
            <input type="text" name="brand" id="brand" value="{{ old('brand') }}" class="form-control"><br />

            <label>Opis</label><br />
            <input type="textarea" name="description" id="description" value="{{ old('description') }}" class="form-control"><br />

            <label>Dostawca</label><br />
            <input type="text" name="shipper" id="shipper" value="{{ old('shipper') }}" class="form-control"><br />
        

            <label>Stan</label><br />
            <input type="text" name="condition" id="condition" value="{{ old('condition') }}" class="form-control"><br />
            
            <label>Cena</label><br />
            <input type="text" name="price" id="price" value="{{ old('price') }}" class="form-control"><br />

            <input type="submit" value="Dodaj" class="btn btn-success"><br />
        </form>

    </div>
</div>

@endsection