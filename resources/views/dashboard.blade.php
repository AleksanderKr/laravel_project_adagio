<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adagio</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>

   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Adagio</a>
      <a class="navbar-brand" href="/users">usercrud</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          
          <li class="nav-item">
            <a class="nav-link" href="#" tabindex="-1" >user profile</a>
          </li>
        </ul>

        <form class="d-flex" style="margin-right: 200px;" method="get" action="{{ url('/search') }}">
          @csrf
          
          <input class="form-control me-2" style="width: 600px;" type="text" id="search" name="search" placeholder="Search" aria-label="Search">
          <select name="category_dropdown">
            
              <option>Wszystkie</option>  
              <option>Elektronika</option>
              <option>Dom i ogród</option>
              <option>AGD</option>
              <option>Spożywcze</option>
              <option>Moda</option>
              <option>Zdrowie</option>
              <option>Motoryzacja</option>
            
          </select>
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      <!-- popup -->
        <form method="get" action="{{ url('/searchMultiple') }}">    
          @csrf
          <button class="btn btn-sm btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#reg-modal">Search multiple</button>
          <div class="modal fade" id="reg-modal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal-title"> Wpisz, czego szukasz</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  
                  <input type="text" name="first_field" placeholder="1. przedmiot" value="" />
                  <br />
                  <br />
                  <input type="text" name="second_field" placeholder="2. przedmiot" value="" />
                </div>
                <div class="modal-footer">
                  <button class="btn btn-warning" type="submit">Search</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <a href="#" style="color: white;">LOGOOWANIE</a>
    </div>
  </nav>

  <div class="card">
    <div class="card-body">

    </div>
  </div>

  <div class="container">
    <br />    
        <div class="row">

            @foreach ($offers as $offer)
            <div class="col-4">
                <div class="card" style="margin: 20px;">
                    <div class="card-header" style="background-color: rgb(242, 184, 76);">Offer id: {{ $offer->id }}</div>
                    <div class="card-body" style="background-color:rgb(224, 243, 194)">
                      <p>Item name: {{ $offer->item_name }}</p>
                      <p>Category: {{ $offer->category }}</p>
                      <p>Seller id: {{ $offer->seller_id }}</p>
                      <p class="text-danger">Price: {{ $offer->price }}</p>
                      <img src="{{ $offer->pictures }}" width ="40%" height="40%" alt="no image found" />
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                        </div>
                        
                    </div>
                </div>
            </div>
            @endforeach
            
    </div>
    <div class="row" style="float: right;" >{{ $offers->links() }}</div>
</div>

</body>
</html>
